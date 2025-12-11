<?php

namespace App\Http\Controllers;

use App\Models\mariage;
use App\Models\RegimeMatrimoniale;
use App\Models\User;
use App\Models\typeRole;
use App\Models\contrat;
use App\Models\commune;
use App\Models\province;
use App\Models\statu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    public function index()
    {
        // Statistiques générales des mariages
        $totalMariages = mariage::count();
        $mariagesCeMois = mariage::whereMonth('date_mariage', Carbon::now()->month)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();

        // Statistiques des utilisateurs
        $totalUsers = User::count();
        $usersParRole = typeRole::withCount('users')->get();
        $derniersUsers = User::with('typeRole')->latest()->take(5)->get();

        // Statistiques des contrats
        $totalContrats = contrat::count();
        $contratsParType = contrat::selectRaw('type_contrat, count(*) as total')
            ->groupBy('type_contrat')
            ->get();

        // Statistiques des régimes matrimoniaux
        $totalRegimes = RegimeMatrimoniale::count();
        $regimesActifs = RegimeMatrimoniale::where('dotation_cutinier', 10)->count();

        // Statistiques géographiques
        $totalProvinces = province::count();
        $totalCommunes = commune::count();

        // Statistiques des mariages par province (basé sur l'adresse des époux)
        $mariagesParProvince = 5;

        // Statistiques des mariages par commune (basé sur l'adresse des époux)
        $mariagesParCommune = 5;

   // Statistiques des statuts
        $totalStatus = Statu::count();
        $mariagesParStatus = DB::table('mariages')
            ->select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->get()
            ->map(function ($item) {
                $status = Statu::find($item->status_id);
                return (object) [
                    'nom' => $status ? $status->nom : 'Non défini',
                    'total' => $item->total
                ];
            });

        // Rapports récents (derniers 6 mois)
        $rapportsRecents = collect();

        // Rapports mensuels des 6 derniers mois
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->subMonths($i);
            $mois = $date->month;
            $annee = $date->year;

            $total = mariage::whereMonth('date_mariage', $mois)
                ->whereYear('date_mariage', $annee)
                ->count();

            if ($total > 0) {
                $rapportsRecents->push((object) [
                    'type' => 'Mensuel',
                    'periode' => $date->format('F Y'),
                    'total' => $total,
                    'lien_voir' => route('rapports.mensuel', ['mois' => $mois, 'annee' => $annee]),
                    'lien_imprimer' => route('rapports.mensuel.print', ['mois' => $mois, 'annee' => $annee])
                ]);
            }
        }

        // Rapport annuel de l'année en cours
        $totalAnnuel = mariage::whereYear('date_mariage', Carbon::now()->year)->count();
        if ($totalAnnuel > 0) {
            $rapportsRecents->push((object) [
                'type' => 'Annuel',
                'periode' => Carbon::now()->year,
                'total' => $totalAnnuel,
                'lien_voir' => route('rapports.annuel', ['annee' => Carbon::now()->year]),
                'lien_imprimer' => route('rapports.annuel.print', ['annee' => Carbon::now()->year])
            ]);
        }

        return view('overviews', compact(
            'totalMariages',
            'mariagesCeMois',
            'rapportsRecents',
            'totalUsers',
            'usersParRole',
            'derniersUsers',
            'totalContrats',
            'contratsParType',
            'totalRegimes',
            'regimesActifs',
            'totalProvinces',
            'totalCommunes',
            'mariagesParProvince',
            'mariagesParCommune',
            'totalStatus',
            'mariagesParStatus'
        ));
    }
}
