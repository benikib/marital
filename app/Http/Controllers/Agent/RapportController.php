<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Mariage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class RapportController extends Controller
{
    public function mensuel()
    {
        $entite = auth()->user()->entite;
        $mois = request('mois', Carbon::now()->month);
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereMonth('date_mariage', $mois)
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        return view('agents.rapports.mensuel', compact('mariages', 'total', 'parStatus', 'mois', 'annee'));
    }

    public function annuel()
    {
        $entite = auth()->user()->entite;
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parMois = $mariages->groupBy(function ($mariage) {
            return Carbon::parse($mariage->date_mariage)->format('m');
        })->map(function ($group) {
            return $group->count();
        });

        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        return view('agents.rapports.annuel', compact('mariages', 'total', 'parMois', 'parStatus', 'annee'));
    }

    public function exportMensuel()
    {
        $entite = auth()->user()->entite;
        $mois = request('mois', Carbon::now()->month);
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereMonth('date_mariage', $mois)
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        $pdf = PDF::loadView('agents.rapports.export-mensuel', compact('mariages', 'total', 'parStatus', 'mois', 'annee', 'entite'));
        return $pdf->download('rapport-mensuel-' . ($entite?->nom ?? 'entite') . '-' . $mois . '-' . $annee . '.pdf');
    }

    public function exportAnnuel()
    {
        $entite = auth()->user()->entite;
        $annee = request('annee', Carbon::now()->year);
        $mariages = mariage::with(['epoux', 'epouse', 'status'])
            ->when($entite, function ($q) use ($entite) { return $q->where('entite_id', $entite->id); })
            ->whereYear('date_mariage', $annee)
            ->get();

        $total = $mariages->count();
        $parMois = $mariages->groupBy(function ($mariage) {
            return Carbon::parse($mariage->date_mariage)->format('m');
        })->map(function ($group) {
            return $group->count();
        });

        $parStatus = $mariages->groupBy('status_id')
            ->map(function ($group) {
                return $group->count();
            });

        $pdf = PDF::loadView('agents.rapports.export-annuel', compact('mariages', 'total', 'parMois', 'parStatus', 'annee', 'entite'));
        return $pdf->download('rapport-annuel-' . ($entite?->nom ?? 'entite') . '-' . $annee . '.pdf');
    }

    public function statistiques()
    {
        $entite = auth()->user()->entite;
        $type = request('type', 'province'); // province, district, commune, secteur, territoire
        $annee = request('annee', Carbon::now()->year);
        $mois = request('mois'); // optionnel pour filtrer par mois

        // Base query avec relations
        $query = Mariage::with(['epoux', 'epouse', 'commune.province', 'status'])
            ->when($entite, function ($q) use ($entite) {
                return $q->where('entite_id', $entite->id);
            })
            ->whereYear('date_mariage', $annee)
            ->when($mois, function ($q) use ($mois) {
                return $q->whereMonth('date_mariage', $mois);
            });

        $mariages = $query->get();

        // Statistiques par type de localisation
        $statistiques = [];

        switch ($type) {
            case 'province':
                $statistiques = $this->getStatsByProvince($mariages);
                break;
            case 'district':
                $statistiques = $this->getStatsByDistrict($mariages);
                break;
            case 'commune':
                $statistiques = $this->getStatsByCommune($mariages);
                break;
            case 'secteur':
                $statistiques = $this->getStatsBySecteur($mariages);
                break;
            case 'territoire':
                $statistiques = $this->getStatsByTerritoire($mariages);
                break;
            default:
                $statistiques = $this->getStatsByProvince($mariages);
        }

        // Statistiques générales
        $totalMariages = $mariages->count();
        $parStatus = $mariages->groupBy('status.nom')->map->count();

        // Statistiques démographiques
        $statsDemographiques = [
            'moyenne_age_epoux' => $mariages->avg(function ($mariage) {
                return Carbon::parse($mariage->epoux->date_naissance)->age;
            }),
            'moyenne_age_epouse' => $mariages->avg(function ($mariage) {
                return Carbon::parse($mariage->epouse->date_naissance)->age;
            }),
            'par_nationalite_epoux' => $mariages->groupBy('epoux.nationalite')->map->count(),
            'par_nationalite_epouse' => $mariages->groupBy('epouse.nationalite')->map->count(),
            'par_profession_epoux' => $mariages->groupBy('epoux.profession')->map->count(),
            'par_profession_epouse' => $mariages->groupBy('epouse.profession')->map->count(),
        ];

        return view('agents.rapports.statistiques', compact(
            'statistiques',
            'totalMariages',
            'parStatus',
            'statsDemographiques',
            'type',
            'annee',
            'mois'
        ));
    }

    private function getStatsByProvince($mariages)
    {
        return $mariages->groupBy(function ($mariage) {
            return $mariage->epoux->province ?? $mariage->epouse->province ?? 'Non spécifié';
        })->map(function ($group, $province) {
            return [
                'localisation' => $province,
                'total' => $group->count(),
                'hommes' => $group->where('epoux.sexe', 'M')->count(),
                'femmes' => $group->where('epouse.sexe', 'F')->count(),
                'par_status' => $group->groupBy('status.nom')->map->count(),
                'moyenne_age_epoux' => $group->avg(function ($m) {
                    return Carbon::parse($m->epoux->date_naissance)->age;
                }),
                'moyenne_age_epouse' => $group->avg(function ($m) {
                    return Carbon::parse($m->epouse->date_naissance)->age;
                }),
            ];
        })->sortByDesc('total');
    }

    private function getStatsByDistrict($mariages)
    {
        return $mariages->groupBy(function ($mariage) {
            return $mariage->epoux->district ?? $mariage->epouse->district ?? 'Non spécifié';
        })->map(function ($group, $district) {
            return [
                'localisation' => $district,
                'total' => $group->count(),
                'hommes' => $group->where('epoux.sexe', 'M')->count(),
                'femmes' => $group->where('epouse.sexe', 'F')->count(),
                'par_status' => $group->groupBy('status.nom')->map->count(),
            ];
        })->sortByDesc('total');
    }

    private function getStatsByCommune($mariages)
    {
        return $mariages->groupBy(function ($mariage) {
            return $mariage->commune->nom ?? 'Non spécifié';
        })->map(function ($group, $commune) {
            return [
                'localisation' => $commune,
                'total' => $group->count(),
                'hommes' => $group->where('epoux.sexe', 'M')->count(),
                'femmes' => $group->where('epouse.sexe', 'F')->count(),
                'par_status' => $group->groupBy('status.nom')->map->count(),
            ];
        })->sortByDesc('total');
    }

    private function getStatsBySecteur($mariages)
    {
        return $mariages->groupBy(function ($mariage) {
            return $mariage->epoux->secteur ?? $mariage->epouse->secteur ?? 'Non spécifié';
        })->map(function ($group, $secteur) {
            return [
                'localisation' => $secteur,
                'total' => $group->count(),
                'hommes' => $group->where('epoux.sexe', 'M')->count(),
                'femmes' => $group->where('epouse.sexe', 'F')->count(),
                'par_status' => $group->groupBy('status.nom')->map->count(),
            ];
        })->sortByDesc('total');
    }

    private function getStatsByTerritoire($mariages)
    {
        return $mariages->groupBy(function ($mariage) {
            return $mariage->epoux->territoire ?? $mariage->epouse->territoire ?? 'Non spécifié';
        })->map(function ($group, $territoire) {
            return [
                'localisation' => $territoire,
                'total' => $group->count(),
                'hommes' => $group->where('epoux.sexe', 'M')->count(),
                'femmes' => $group->where('epouse.sexe', 'F')->count(),
                'par_status' => $group->groupBy('status.nom')->map->count(),
            ];
        })->sortByDesc('total');
    }

    public function exportStatistiques()
    {
        $entite = auth()->user()->entite;
        $type = request('type', 'province');
        $annee = request('annee', Carbon::now()->year);
        $mois = request('mois');

        // Même logique que la méthode statistiques()
        $query = Mariage::with(['epoux', 'epouse', 'commune.province', 'status'])
            ->when($entite, function ($q) use ($entite) {
                return $q->where('entite_id', $entite->id);
            })
            ->whereYear('date_mariage', $annee)
            ->when($mois, function ($q) use ($mois) {
                return $q->whereMonth('date_mariage', $mois);
            });

        $mariages = $query->get();

        $statistiques = [];

        switch ($type) {
            case 'province':
                $statistiques = $this->getStatsByProvince($mariages);
                break;
            case 'district':
                $statistiques = $this->getStatsByDistrict($mariages);
                break;
            case 'commune':
                $statistiques = $this->getStatsByCommune($mariages);
                break;
            case 'secteur':
                $statistiques = $this->getStatsBySecteur($mariages);
                break;
            case 'territoire':
                $statistiques = $this->getStatsByTerritoire($mariages);
                break;
        }

        $totalMariages = $mariages->count();
        $parStatus = $mariages->groupBy('status.nom')->map->count();

        $pdf = PDF::loadView('agents.rapports.export-statistiques', compact(
            'statistiques',
            'totalMariages',
            'parStatus',
            'type',
            'annee',
            'mois',
            'entite'
        ));

        $filename = 'statistiques-' . $type . '-' . ($entite?->nom ?? 'entite') . '-' . $annee;
        if ($mois) {
            $filename .= '-' . $mois;
        }
        $filename .= '.pdf';

        return $pdf->download($filename);
    }
}
