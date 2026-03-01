<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Mariage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OverviewController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $entite = $user->entite;

        if (! $entite) {
            $totalMariages = 0;
            $mariagesCeMois = 0;
            $mariagesCetteAnnee = 0;
            $mariagesEnAttente = 0;
            $mariagesValides = 0;
            $mariagesAnnules = 0;
            $evolutionMariages = collect();
            $derniersMariages = collect();

            return view('agents.overviews', compact(
                'totalMariages',
                'mariagesCeMois',
                'mariagesCetteAnnee',
                'mariagesEnAttente',
                'mariagesValides',
                'mariagesAnnules',
                'evolutionMariages',
                'derniersMariages'
            ));
        }

        $entiteId = $entite->id;

        // Statistiques générales
        $totalMariages = mariage::where('entite_id', $entiteId)->count();
        $mariagesCeMois = mariage::where('entite_id', $entiteId)
            ->whereMonth('date_mariage', Carbon::now()->month)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();
        $mariagesCetteAnnee = mariage::where('entite_id', $entiteId)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();
        $mariagesEnAttente = 0;

        // Statistiques par statut
        $mariagesValides = 0;
        $mariagesAnnules =0;

    $evolutionMariages = mariage::where('entite_id', $entiteId)
    ->where('date_mariage', '>=', Carbon::now()->subMonths(6))
    ->select(
        DB::raw('DATE_FORMAT(date_mariage, "%M %Y") as mois'),
        DB::raw('COUNT(*) as total'),
        DB::raw('MIN(date_mariage) as date_min') // Ajouté pour le tri
    )
    ->groupBy('mois')
    ->orderBy('date_min') // Tri par la date minimale du groupe
    ->get();
        // Derniers mariages
        $derniersMariages = mariage::where('entite_id', $entiteId)
            ->orderBy('date_mariage', 'desc')
            ->take(5)
            ->get();

        return view('agents.overviews', compact(
            'totalMariages',
            'mariagesCeMois',
            'mariagesCetteAnnee',
            'mariagesEnAttente',
            'mariagesValides',
            'mariagesAnnules',
            'evolutionMariages',
            'derniersMariages'
        ));
    }
}
