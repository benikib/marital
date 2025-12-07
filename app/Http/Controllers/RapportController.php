<?php

namespace App\Http\Controllers;

use App\Models\Mariage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RapportController extends Controller
{
    public function mensuel()
    {
        $moisActuel = Carbon::now()->month;
        $anneeActuelle = Carbon::now()->year;

        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->whereMonth('date_mariage', $moisActuel)
            ->whereYear('date_mariage', $anneeActuelle)
            ->get();

        $statistiques = [
            'total' => $mariages->count(),
            'parProvince' => $mariages->groupBy('epoux.province')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parStatut' => $mariages->groupBy('status.nom')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parRegime' => $mariages->groupBy('regimeMatrimonial.contrat.type_contrat')
                ->map(function ($group) {
                    return $group->count();
                })
        ];

        return view('rapports.mensuel', compact('mariages', 'statistiques', 'moisActuel', 'anneeActuelle'));
    }

    public function annuel()
    {
        $anneeActuelle = Carbon::now()->year;

        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->whereYear('date_mariage', $anneeActuelle)
            ->get();

        $statistiques = [
            'total' => $mariages->count(),
            'parMois' => $mariages->groupBy(function ($mariage) {
                return Carbon::parse($mariage->date_mariage)->format('m');
            })->map(function ($group) {
                return $group->count();
            }),
            'parProvince' => $mariages->groupBy('epoux.province')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parStatut' => $mariages->groupBy('status.nom')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parRegime' => $mariages->groupBy('regimeMatrimonial.contrat.type_contrat')
                ->map(function ($group) {
                    return $group->count();
                })
        ];

        return view('rapports.annuel', compact('mariages', 'statistiques', 'anneeActuelle'));
    }

    public function printMensuel($mois, $annee)
    {
        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->whereMonth('date_mariage', $mois)
            ->whereYear('date_mariage', $annee)
            ->get();

        $statistiques = [
            'total' => $mariages->count(),
            'parProvince' => $mariages->groupBy('epoux.province')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parStatut' => $mariages->groupBy('status.nom')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parRegime' => $mariages->groupBy('regimeMatrimonial.contrat.type_contrat')
                ->map(function ($group) {
                    return $group->count();
                })
        ];

        $moisNom = Carbon::createFromDate($annee, $mois, 1)->locale('fr')->isoFormat('MMMM YYYY');

        return view('rapports.print-mensuel', compact('mariages', 'statistiques', 'moisNom'));
    }

    public function printAnnuel($annee)
    {
        $mariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->whereYear('date_mariage', $annee)
            ->get();

        $statistiques = [
            'total' => $mariages->count(),
            'parMois' => $mariages->groupBy(function ($mariage) {
                return Carbon::parse($mariage->date_mariage)->format('m');
            })->map(function ($group) {
                return $group->count();
            }),
            'parProvince' => $mariages->groupBy('epoux.province')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parStatut' => $mariages->groupBy('status.nom')
                ->map(function ($group) {
                    return $group->count();
                }),
            'parRegime' => $mariages->groupBy('regimeMatrimonial.contrat.type_contrat')
                ->map(function ($group) {
                    return $group->count();
                })
        ];

        return view('rapports.print-annuel', compact('mariages', 'statistiques', 'annee'));
    }
}
