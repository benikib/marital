<?php

namespace App\Http\Controllers;

use App\Models\BonneVieMoeurs;
use App\Models\User;
use App\Models\Mariage;
use App\Models\Dece;
use App\Models\Celibat;
use App\Models\Inhumation;
use App\Models\Naissance;
use App\Models\Residence;
use App\Models\Veuvage;
use App\Models\Nationalite;
use App\Models\Personne;
use App\Models\EntiteAdministrative;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ProvinceDashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        
        // Récupérer la province de l'admin (via son entite_id)
        $provinceId = $user->entite_id;
        $province = EntiteAdministrative::find($provinceId);
        
        // Récupérer tous les IDs des entités sous cette province (villes, communes, territoires)
        $entiteIds = $this->getAllChildEntiteIds($provinceId);
        $entiteIds[] = $provinceId;
        
        // Statistiques générales
        $stats = $this->getGlobalStats($entiteIds);
        
        // Statistiques par ville
        $statsParVille = $this->getStatsByVille($provinceId);
        
        // Statistiques par type d'acte
        $statsParActe = $this->getStatsByActe($entiteIds);
        
        // Évolution des actes (12 derniers mois)
        $evolution = $this->getEvolution($entiteIds);
        
        // Top 5 des villes les plus actives
        $topVilles = $this->getTopVilles($provinceId);
        
        // Statistiques des agents par ville
 $agentsStats = $this->getAgentsStatsByVille($provinceId);
        
        // Graphiques pour le dashboard
        $charts = $this->prepareChartsData($entiteIds);
        
        // Période sélectionnée pour les rapports
        $period = $request->get('period', 'today');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
       //dd($evolution, $endDate);
        return view('dashboard.province', compact(
            'province',
            'stats',
            'statsParVille',
            'statsParActe',
            'evolution',
            'topVilles',
            'agentsStats',
            'charts',
            'period',
            'startDate',
            'endDate'
        ));
    }
    
    /**
     * Récupérer tous les IDs des entités enfants (villes, communes, territoires)
     */
    private function getAllChildEntiteIds($provinceId)
    {
        $ids = [];
        
        // Récupérer les villes de la province
        $villes = EntiteAdministrative::where('parent_id', $provinceId)
            
            ->pluck('id')
            ->toArray();
        
        $ids = array_merge($ids, $villes);
        
        // Récupérer les communes des villes
        foreach ($villes as $villeId) {
            $communes = EntiteAdministrative::where('parent_id', $villeId)
                
                ->pluck('id')
                ->toArray();
            $ids = array_merge($ids, $communes);
        }
        
        // Récupérer les territoires de la province
        $territoires = EntiteAdministrative::where('parent_id', $provinceId)
            ->pluck('id')
            ->toArray();
        
        $ids = array_merge($ids, $territoires);
        
        return $ids;
    }
    
    /**
     * Statistiques globales
     */
    private function getGlobalStats($entiteIds)
    {
        return [
            'total_personnes' => Personne::whereIn('entite_id', $entiteIds)->count(),
            'total_mariages' => Mariage::whereIn('entite_id', $entiteIds)->count(),
            'total_naissances' => Naissance::whereIn('entite_id', $entiteIds)->count(),
            'total_deces' => Dece::whereIn('entite_id', $entiteIds)->count(),
            'total_celibats' => Celibat::whereIn('entite_id', $entiteIds)->count(),
            'total_residences' => Residence::whereIn('entite_id', $entiteIds)->count(),
            'total_veuvages' => Veuvage::whereIn('entite_id', $entiteIds)->count(),
            'total_nationalites' => Nationalite::whereIn('entite_id', $entiteIds)->count(),
            'total_agents' => User::where('entite_id', $entiteIds)->count(),
            'total_villes' => EntiteAdministrative::where('parent_id', $entiteIds[0] ?? 0)
                ->count(),
        ];
    }
    
    /**
     * Statistiques par ville
     */
    private function getStatsByVille($provinceId)
    {
        // Cache les statistiques pendant 1 heure
        return Cache::remember("province_stats_{$provinceId}", 3600, function () use ($provinceId) {
            $villes = EntiteAdministrative::where('parent_id', $provinceId)->get();
        
        $stats = [];
        foreach ($villes as $ville) {
            $entiteIds = [$ville->id];
            
            // Ajouter les communes de la ville
            $communes = EntiteAdministrative::where('parent_id', $ville->id)
                ->pluck('id')
                ->toArray();
            $entiteIds = array_merge($entiteIds, $communes);
            
            $stats[] = [
                'ville' => $ville->nom,
                'ville_id' => $ville->id,
                'mariages' => Mariage::whereIn('entite_id', $entiteIds)->count(),
                'naissances' => Naissance::whereIn('entite_id', $entiteIds)->count(),
                'deces' => Dece::whereIn('entite_id', $entiteIds)->count(),
                'celibats' => Celibat::whereIn('entite_id', $entiteIds)->count(),
                'residences' => Residence::whereIn('entite_id', $entiteIds)->count(),
                'veuvages' => Veuvage::whereIn('entite_id', $entiteIds)->count(),
                'nationalites' => Nationalite::whereIn('entite_id', $entiteIds)->count(),
                'Bonneviemoeurs'=> BonneVieMoeurs::whereIn('entite_id', $entiteIds)->count(),
                'inhumations' => Inhumation::whereIn('entite_id', $entiteIds)->count(),
                'agents' => User::whereIn('entite_id', $entiteIds)->count(),
                'total' => 0, // Calculé plus tard
            ];
            
            $stats[count($stats) - 1]['total'] = 
                $stats[count($stats) - 1]['mariages'] +
                $stats[count($stats) - 1]['naissances'] +
                $stats[count($stats) - 1]['deces'] +
                $stats[count($stats) - 1]['celibats'] +
                $stats[count($stats) - 1]['residences'] +
                $stats[count($stats) - 1]['veuvages'] +
                $stats[count($stats) - 1]['nationalites'] +
                $stats[count($stats) - 1]['Bonneviemoeurs'] +
                $stats[count($stats) - 1]['inhumations'];
        }
        
        return collect($stats)->sortByDesc('total')->values();
        });
    }
    
    /**
     * Statistiques par type d'acte
     */
    private function getStatsByActe($entiteIds)
    {
        return [
            'mariages' => Mariage::whereIn('entite_id', $entiteIds)->count(),
            'naissances' => Naissance::whereIn('entite_id', $entiteIds)->count(),
            'deces' => Dece::whereIn('entite_id', $entiteIds)->count(),
            'celibats' => Celibat::whereIn('entite_id', $entiteIds)->count(),
            'inhumations' => Inhumation::whereIn('entite_id', $entiteIds)->count(),
            'residences' => Residence::whereIn('entite_id', $entiteIds)->count(),
            'veuvages' => Veuvage::whereIn('entite_id', $entiteIds)->count(),
            'nationalites' => Nationalite::whereIn('entite_id', $entiteIds)->count(),
            'Bonneviemoeurs' => BonneVieMoeurs::whereIn('entite_id', $entiteIds)->count(),
            
            'total' => 0, // Calculé plus tard
        ];
    }
    
    /**
     * Évolution des actes sur 12 mois
     */
    private function getEvolution($entiteIds)
    {
        $evolution = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $mois = $date->format('M Y');
            
            $evolution['mariages'][$mois] = Mariage::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $evolution['naissances'][$mois] = Naissance::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $evolution['deces'][$mois] = Dece::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $evolution['celibats'][$mois] = Celibat::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $evolution['residences'][$mois] = Residence::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $evolution['veuvages'][$mois] = Veuvage::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $evolution['nationalites'][$mois] = Nationalite::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $evolution['Bonneviemoeurs'][$mois] = BonneVieMoeurs::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $evolution['inhumations'][$mois] = Inhumation::whereIn('entite_id', $entiteIds)
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();

        }
        
        return $evolution;
    }
    
    /**
     * Top 5 des villes les plus actives
     */
    private function getTopVilles($provinceId)
    {
        $stats = $this->getStatsByVille($provinceId);
        return $stats->take(5);
    }
    
    /**
     * Statistiques des agents par ville
     */
    private function getAgentsStatsByVille($provinceId)
    {
        $villes = EntiteAdministrative::where('parent_id', $provinceId)
            
            ->get();
        
        $stats = [];
        foreach ($villes as $ville) {
            $entiteIds = [$ville->id];
            $communes = EntiteAdministrative::where('parent_id', $ville->id)
                
                ->pluck('id')
                ->toArray();
            $entiteIds = array_merge($entiteIds, $communes);
            
            $stats[] = [
                'ville' => $ville->nom,
                'total_agents' => User::whereIn('entite_id', $entiteIds)
                    
                    ->count(),
                'actifs' => User::whereIn('entite_id', $entiteIds)
                    
                    
                    ->count(),
            ];
        }
        
        return collect($stats);
    }
    
    /**
     * Préparer les données pour les graphiques
     */
    private function prepareChartsData($entiteIds)
    {
        // Actes par type
        $actesParType = [
            'Mariages' => Mariage::whereIn('entite_id', $entiteIds)->count(),
            'Naissances' => Naissance::whereIn('entite_id', $entiteIds)->count(),
            'Décès' => Dece::whereIn('entite_id', $entiteIds)->count(),
            'Célibats' => Celibat::whereIn('entite_id', $entiteIds)->count(),
            'Résidences' => Residence::whereIn('entite_id', $entiteIds)->count(),
        ];
        
        // Actes par mois (dernier 6 mois)
        $actesParMois = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $mois = $date->format('F');
            
            $actesParMois[$mois] = [
                'mois' => $mois,
                'mariages' => Mariage::whereIn('entite_id', $entiteIds)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'naissances' => Naissance::whereIn('entite_id', $entiteIds)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
                'deces' => Dece::whereIn('entite_id', $entiteIds)
                    ->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count(),
            ];
        }
        
        return [
            'actes_par_type' => $actesParType,
            'actes_par_mois' => array_values($actesParMois),
        ];
    }
    
    /**
     * Obtenir les détails d'une ville spécifique
     */
    public function villeDetails($villeId)
    {
        $ville = EntiteAdministrative::findOrFail($villeId);
        $entiteIds = [$villeId];
        
        // Ajouter les communes
        $communes = EntiteAdministrative::where('parent_id', $villeId)
            
            ->pluck('id')
            ->toArray();
        $entiteIds = array_merge($entiteIds, $communes);
        
        $data = [
            'ville' => $ville,
            'stats' => [
                'mariages' => Mariage::whereIn('entite_id', $entiteIds)->count(),
                'naissances' => Naissance::whereIn('entite_id', $entiteIds)->count(),
                'deces' => Dece::whereIn('entite_id', $entiteIds)->count(),
                'celibats' => Celibat::whereIn('entite_id', $entiteIds)->count(),
                'residences' => Residence::whereIn('entite_id', $entiteIds)->count(),
            ],
            'agents' => User::whereIn('entite_id', $entiteIds)
                ->where('role', 'agent')
                ->get(),
            'communes' => $communes,
        ];
        
        return response()->json($data);
    }
    
    /**
     * Export des statistiques
     */
    public function exportStats(Request $request)
    {
        $user = auth()->user();
        $provinceId = $user->entite_id;
        $entiteIds = $this->getAllChildEntiteIds($provinceId);
        $entiteIds[] = $provinceId;
        
        $stats = $this->getGlobalStats($entiteIds);
        $statsParVille = $this->getStatsByVille($provinceId);
        
        // Générer l'export Excel
        return Excel::download(new ProvinceStatsExport($stats, $statsParVille), 'statistiques_province.xlsx');
    }

    
}