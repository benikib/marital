<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\mariage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $commune = auth()->user()->commune;

        // Statistiques pour le mois en cours
        $mariagesMois = Mariage::where('commune_id', $commune->id)
            ->whereMonth('date_mariage', Carbon::now()->month)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();

        // Statistiques pour l'année en cours
        $mariagesAnnee = mariage::where('commune_id', $commune->id)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();

        // Total des mariages
        $totalMariages = mariage::where('commune_id', $commune->id)->count();

        // Derniers mariages enregistrés
        $derniersMariages = mariage::with(['epoux', 'epouse', 'status'])
            ->where('commune_id', $commune->id)
            ->latest()
            ->take(5)
            ->get();

        // Statistiques mensuelles pour le graphique
        $statsMensuelles = mariage::where('commune_id', $commune->id)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->select(
                DB::raw('MONTH(date_mariage) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->map(function ($item) {
                return [
                    'mois' => Carbon::create()->month($item->mois)->format('M'),
                    'total' => $item->total
                ];
            });

        return view('agents.dashboard', compact(
            'mariagesMois',
            'mariagesAnnee',
            'totalMariages',
            'derniersMariages',
            'statsMensuelles'
        ));
    }

    public function overviews()
    {
        $commune = auth()->user()->commune;

        // Statistiques par statut
        $statsParStatut = mariage::where('commune_id', $commune->id)
            ->select('status_id', DB::raw('count(*) as total'))
            ->groupBy('status_id')
            ->with('status')
            ->get();

        // Statistiques par année
        $statsParAnnee = mariage::where('commune_id', $commune->id)
            ->select(DB::raw('YEAR(date_mariage) as annee'), DB::raw('count(*) as total'))
            ->groupBy('annee')
            ->orderBy('annee', 'desc')
            ->get();

        // Statistiques par mois de l'année en cours
        $statsParMois = mariage::where('commune_id', $commune->id)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->select(DB::raw('MONTH(date_mariage) as mois'), DB::raw('count(*) as total'))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get()
            ->map(function ($item) {
                return [
                    'mois' => Carbon::create()->month($item->mois)->format('F'),
                    'total' => $item->total
                ];
            });

        return view('agents.overviews', compact(
            'statsParStatut',
            'statsParAnnee',
            'statsParMois'
        ));
    }
}
