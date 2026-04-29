<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mariage;
use App\Models\Personne;
use App\Models\User;

use Illuminate\Support\Facades\DB;
use App\Models\Dece;
use App\Models\Celibat;
use App\Models\Inhumation;
use App\Models\Divorce;
use App\Models\Naissance;
use App\Models\EntiteAdministrative;
use App\Models\Veuvage;
use Illuminate\Support\Facades\Auth;
use App\Models\Residence;
use App\Models\Nationalite;
use App\Models\BonneVieMoeurs;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RapportExport;

class DashboardController extends Controller
{
    public function superAdmin()
    { 
        $totalMariages = Mariage::count();
        $totalPersonnes = Personne::count();
        $totalUsers = User::count();
        $entiteId = auth()->user()->entite_id;

        
              


       

//total       

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







    public function agent(Request $request)
    {
        $user = auth()->user();
        $entiteId = $user->entite_id;
        
        // Période sélectionnée
        $period = $request->get('period', 'today');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        $rapportType = $request->get('rapport_type', 'journalier');
        
        // Définir les dates en fonction de la période
        switch ($rapportType) {
            case 'journalier':
                $currentDate = Carbon::now();
                $title = "Rapport Journalier du " . $currentDate->format('d/m/Y');
                $dateCondition = function($query) use ($currentDate) {
                    $query->whereDate('created_at', $currentDate);
                };
                break;
            case 'mensuel':
                $currentDate = Carbon::now();
                $title = "Rapport Mensuel - " . $currentDate->format('F Y');
                $dateCondition = function($query) use ($currentDate) {
                    $query->whereMonth('created_at', $currentDate->month)
                          ->whereYear('created_at', $currentDate->year);
                };
                break;
            case 'annuel':
                $currentDate = Carbon::now();
                $title = "Rapport Annuel - " . $currentDate->format('Y');
                $dateCondition = function($query) use ($currentDate) {
                    $query->whereYear('created_at', $currentDate->year);
                };
                break;
            case 'personnalise':
                if ($startDate && $endDate) {
                    $title = "Rapport Personnalisé du " . Carbon::parse($startDate)->format('d/m/Y') . " au " . Carbon::parse($endDate)->format('d/m/Y');
                    $dateCondition = function($query) use ($startDate, $endDate) {
                        $query->whereDate('created_at', '>=', $startDate)
                              ->whereDate('created_at', '<=', $endDate);
                    };
                } else {
                    $rapportType = 'journalier';
                    $title = "Rapport Journalier du " . Carbon::now()->format('d/m/Y');
                    $dateCondition = function($query) {
                        $query->whereDate('created_at', today());
                    };
                }
                break;
            default:
                $rapportType = 'journalier';
                $title = "Rapport Journalier du " . Carbon::now()->format('d/m/Y');
                $dateCondition = function($query) {
                    $query->whereDate('created_at', today());
                };
                break;
        }
        
        // ========== STATISTIQUES QUOTIDIENNES ==========
        $todayStats = [
            'mariages' => Mariage::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'deces' => Dece::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'celibats' => Celibat::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'inhumations' => Inhumation::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'naissances' => Naissance::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'bonneVieMoeurs' => BonneVieMoeurs::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'residences' => Residence::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'veuvages' => Veuvage::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'nationalites' => Nationalite::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
            'divorces' => Divorce::where('entite_id', $entiteId)
                ->whereDate('created_at', today())->count(),
        ];
        
        // ========== STATISTIQUES MENSUELLES ==========
        $monthlyStats = [
            'mariages' => Mariage::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'deces' => Dece::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'celibats' => Celibat::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'inhumations' => Inhumation::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'naissances' => Naissance::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'residences' => Residence::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'veuvages' => Veuvage::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'nationalites' => Nationalite::where('entite_id', $entiteId)
                ->whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
        ];
        
        // ========== STATISTIQUES ANNUELLES ==========
        $yearlyStats = [
            'mariages' => Mariage::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'deces' => Dece::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'celibats' => Celibat::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'inhumations' => Inhumation::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'naissances' => Naissance::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'residences' => Residence::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'veuvages' => Veuvage::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'nationalites' => Nationalite::where('entite_id', $entiteId)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
        ];
        
        // ========== STATISTIQUES GLOBALES ==========
        $globalStats = [
            'mariages' => Mariage::where('entite_id', $entiteId)->count(),
            'deces' => Dece::where('entite_id', $entiteId)->count(),
            'celibats' => Celibat::where('entite_id', $entiteId)->count(),
            'inhumations' => Inhumation::where('entite_id', $entiteId)->count(),
            'naissances' => Naissance::where('entite_id', $entiteId)->count(),
            'bonneVieMoeurs' => BonneVieMoeurs::where('entite_id', $entiteId)->count(),
            'residences' => Residence::where('entite_id', $entiteId)->count(),
            'veuvages' => Veuvage::where('entite_id', $entiteId)->count(),
            'nationalites' => Nationalite::where('entite_id', $entiteId)->count(),
            'divorces' => Divorce::where('entite_id', $entiteId)->count(),
        ];
        
        // ========== DONNÉES POUR LE RAPPORT ==========
        $rapportData = [
            'mariages' => Mariage::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'naissances' => Naissance::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'deces' => Dece::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'celibats' => Celibat::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'inhumations' => Inhumation::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'residences' => Residence::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'veuvages' => Veuvage::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'nationalites' => Nationalite::where('entite_id', $entiteId)->where($dateCondition)->get(),
        ];
        
        // Statistiques pour le rapport
        $rapportStats = [
            'total_mariages' => $rapportData['mariages']->count(),
            'total_naissances' => $rapportData['naissances']->count(),
            'total_deces' => $rapportData['deces']->count(),
            'total_celibats' => $rapportData['celibats']->count(),
            'total_inhumations' => $rapportData['inhumations']->count(),
            'total_residences' => $rapportData['residences']->count(),
            'total_veuvages' => $rapportData['veuvages']->count(),
            'total_nationalites' => $rapportData['nationalites']->count(),
            'total_general' => 0
        ];
        
        $rapportStats['total_general'] = array_sum($rapportStats) - $rapportStats['total_general'];
        
        // Évolution des mariages (12 derniers mois)
        $mariagesParMois = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $mois = $date->format('M Y');
            $mariagesParMois[$mois] = Mariage::where('entite_id', $entiteId)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }
        
        // Statistiques des personnes
        $personnesStats = [
            'total' => Personne::count(),
            'hommes' => Personne::where('sexe', 'M')->count(),
            'femmes' => Personne::where('sexe', 'F')->count(),
            'ajourd_hui' => Personne::whereDate('created_at', today())->count(),
            'ce_mois' => Personne::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count(),
            'cette_annee' => Personne::whereYear('created_at', Carbon::now()->year)->count(),
        ];
        
        // Top 5 des actes
        $topActivites = collect($globalStats)->sortDesc()->take(5)->toArray();
        
        // Évolution
        $evolution = [
            'mariages' => $this->calculateEvolution(
                Mariage::where('entite_id', $entiteId)->whereDate('created_at', today())->count(),
                Mariage::where('entite_id', $entiteId)->whereDate('created_at', Carbon::yesterday())->count()
            ),
            'naissances' => $this->calculateEvolution(
                Naissance::where('entite_id', $entiteId)->whereDate('created_at', today())->count(),
                Naissance::where('entite_id', $entiteId)->whereDate('created_at', Carbon::yesterday())->count()
            ),
            'deces' => $this->calculateEvolution(
                Dece::where('entite_id', $entiteId)->whereDate('created_at', today())->count(),
                Dece::where('entite_id', $entiteId)->whereDate('created_at', Carbon::yesterday())->count()
            ),
        ];
        
        return view('dashboard.agent', compact(
            'todayStats',
            'monthlyStats',
            'yearlyStats',
            'globalStats',
            'personnesStats',
            'mariagesParMois',
            'topActivites',
            'evolution',
            'rapportData',
            'rapportStats',
            'rapportType',
            'title',
            'startDate',
            'endDate'
        ));
    }
    
    /**
     * Imprimer le rapport
     */
    public function imprimerRapport(Request $request)
    {
        $user = auth()->user();
        $entiteId = $user->entite_id;
        
        $rapportType = $request->get('type', 'journalier');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        // Définir les dates
        switch ($rapportType) {
            case 'journalier':
                $currentDate = Carbon::now();
                $title = "Rapport Journalier du " . $currentDate->format('d/m/Y');
                $dateDebut = $currentDate->copy()->startOfDay();
                $dateFin = $currentDate->copy()->endOfDay();
                $dateCondition = function($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('created_at', [$dateDebut, $dateFin]);
                };
                break;
            case 'mensuel':
                $currentDate = Carbon::now();
                $title = "Rapport Mensuel - " . $currentDate->format('F Y');
                $dateDebut = $currentDate->copy()->startOfMonth();
                $dateFin = $currentDate->copy()->endOfMonth();
                $dateCondition = function($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('created_at', [$dateDebut, $dateFin]);
                };
                break;
            case 'annuel':
                $currentDate = Carbon::now();
                $title = "Rapport Annuel - " . $currentDate->format('Y');
                $dateDebut = $currentDate->copy()->startOfYear();
                $dateFin = $currentDate->copy()->endOfYear();
                $dateCondition = function($query) use ($dateDebut, $dateFin) {
                    $query->whereBetween('created_at', [$dateDebut, $dateFin]);
                };
                break;
            case 'personnalise':
                if ($startDate && $endDate) {
                    $title = "Rapport Personnalisé du " . Carbon::parse($startDate)->format('d/m/Y') . " au " . Carbon::parse($endDate)->format('d/m/Y');
                    $dateDebut = Carbon::parse($startDate)->startOfDay();
                    $dateFin = Carbon::parse($endDate)->endOfDay();
                    $dateCondition = function($query) use ($dateDebut, $dateFin) {
                        $query->whereBetween('created_at', [$dateDebut, $dateFin]);
                    };
                } else {
                    return redirect()->back()->with('error', 'Veuillez sélectionner une période valide');
                }
                break;
            default:
                return redirect()->back()->with('error', 'Type de rapport invalide');
        }
        
        // Récupérer les données
        $rapportData = [
            'mariages' => Mariage::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'naissances' => Naissance::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'deces' => Dece::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'celibats' => Celibat::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'inhumations' => Inhumation::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'residences' => Residence::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'veuvages' => Veuvage::where('entite_id', $entiteId)->where($dateCondition)->get(),
            'nationalites' => Nationalite::where('entite_id', $entiteId)->where($dateCondition)->get(),
        ];
        
        // Statistiques
        $stats = [
            'total_mariages' => $rapportData['mariages']->count(),
            'total_naissances' => $rapportData['naissances']->count(),
            'total_deces' => $rapportData['deces']->count(),
            'total_celibats' => $rapportData['celibats']->count(),
            'total_inhumations' => $rapportData['inhumations']->count(),
            'total_residences' => $rapportData['residences']->count(),
            'total_veuvages' => $rapportData['veuvages']->count(),
            'total_nationalites' => $rapportData['nationalites']->count(),
            'total_general' => 0
        ];
        $stats['total_general'] = array_sum($stats) - $stats['total_general'];
        
        // Informations de l'entité
        $entite = $user->entite;
        $agent = $user;
        
        $data = compact('title', 'rapportData', 'stats', 'entite', 'agent', 'dateDebut', 'dateFin');
        
        // Générer le PDF
        $pdf = Pdf::loadView('rapports.pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        
        // Télécharger le PDF
        return $pdf->download(Str::slug($title) . '.pdf');
    }
    
    /**
     * Exporter le rapport en Excel
     */
    public function exporterExcel(Request $request)
    {
        $user = auth()->user();
        $entiteId = $user->entite_id;
        
        $rapportType = $request->get('type', 'journalier');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        // Logique similaire à imprimerRapport pour récupérer les données
        // Puis exporter en Excel
        
        return Excel::download(new RapportExport($rapportData, $stats), 'rapport.xlsx');
    }
    
    private function calculateEvolution($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 2);
    }
}

