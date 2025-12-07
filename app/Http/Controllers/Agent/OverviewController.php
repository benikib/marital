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
        $communeId = $user->commune_id;

        // Statistiques générales
        $totalMariages = Mariage::where('commune_id', $communeId)->count();
        $mariagesCeMois = Mariage::where('commune_id', $communeId)
            ->whereMonth('date_mariage', Carbon::now()->month)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();
        $mariagesCetteAnnee = Mariage::where('commune_id', $communeId)
            ->whereYear('date_mariage', Carbon::now()->year)
            ->count();
        $mariagesEnAttente = 0;

        // Statistiques par statut
        $mariagesValides = 0;
        $mariagesAnnules =0;

     $evolutionMariages = Mariage::where('commune_id', $communeId)
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
        $derniersMariages = Mariage::where('commune_id', $communeId)
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
