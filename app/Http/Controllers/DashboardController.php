<?php

namespace App\Http\Controllers;

use App\Models\Mariage;
use App\Models\User;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques générales
        $totalMariages = Mariage::count();
        $totalUsers = User::count();
        $totalProvinces = Province::count();

        // Mariages par statut
        $mariagesParStatut = Mariage::select('status.nom', DB::raw('count(*) as total'))
            ->join('status', 'mariages.status_id', '=', 'status.id')
            ->groupBy('status.nom')
            ->get();

        // Mariages par province
        $mariagesParProvince = Mariage::select('epouxes.province', DB::raw('count(*) as total'))
            ->join('epouxes', 'mariages.epoux_id', '=', 'epouxes.id')
            ->groupBy('epouxes.province')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Mariages des 6 derniers mois
        $mariagesParMois = Mariage::select(
            DB::raw('DATE_FORMAT(date_mariage, "%Y-%m") as mois'),
            DB::raw('count(*) as total')
        )
            ->where('date_mariage', '>=', now()->subMonths(6))
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        // Derniers mariages enregistrés
        $derniersMariages = Mariage::with(['epoux', 'epouse', 'status'])
            ->latest()
            ->take(5)
            ->get();


        return view('dashboard', compact(
            'totalMariages',
            'totalUsers',
            'totalProvinces',
            'mariagesParStatut',
            'mariagesParProvince',
            'mariagesParMois',
            'derniersMariages'
        ));
    }
}
