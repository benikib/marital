<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mariage;
use App\Models\Personne;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function superAdmin()
    { 
        $totalMariages = Mariage::count();
        $totalPersonnes = Personne::count();
        $totalUsers = User::count();

    // Mariages par mois
    $mariagesParMois = Mariage::select(
        DB::raw('MONTH(created_at) as mois'),
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('mois')
    ->orderBy('mois')
    ->get();

    $labels = $mariagesParMois->pluck('mois')->map(function($mois) {
        return Carbon::create()->month($mois)->format('M');
    });

    $data = $mariagesParMois->pluck('total');

    // Mariages par statut
    $mariagesParStatut = DB::table('mariages')
        ->join('statuts_mariage', 'mariages.statut_id', '=', 'statuts_mariage.id')
        ->select('statuts_mariage.nom', DB::raw('COUNT(*) as total'))
        ->groupBy('statuts_mariage.nom')
        ->get();

    return view('dashboard.superAdmin', compact(
        'totalMariages',
        'totalPersonnes',
        'totalUsers',
        'labels',
        'data',
        'mariagesParStatut'
    ));

        
    }

    public function admin()
    {
        return view('dashboard');
    }

    public function agent()
    {
         $user = auth()->user();

    // Filtrer par entité de l'agent
    $entiteId = $user->entite_id;

    $totalMariages = Mariage::where('entite_id', $entiteId)->count();

    $mariagesAujourdHui = Mariage::where('entite_id', $entiteId)
        ->whereDate('created_at', today())
        ->count();

    $personnes = Personne::count();

    return view('dashboard.agent', compact(
        'totalMariages',
        'mariagesAujourdHui',
        'personnes'
    ));
       
    }
}
