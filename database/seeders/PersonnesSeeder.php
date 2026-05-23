<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\EntiteAdministrative;
use Carbon\Carbon;

class PersonnesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les entités existantes
        $provinces = EntiteAdministrative::where('type', 'province')->pluck('id', 'nom')->toArray();
        $territoires = EntiteAdministrative::where('type', 'territoire')->pluck('id', 'nom')->toArray();
        $villes = EntiteAdministrative::where('type', 'ville')->pluck('id', 'nom')->toArray();
        
        // Liste des noms typiques congolais
        $noms = [
            'KABUNDA', 'MAMBU', 'TSHIBOLA', 'MULUMBA', 'KASONGO', 'ILUNGA', 'MUTOMBO', 
            'KATEMBO', 'MBUYU', 'KALONJI', 'MUKENDI', 'TSHIMANGA', 'KAPENDA', 'MUTOMBO',
            'KABEYA', 'MULEKA', 'KALALA', 'MUJINGA', 'MWAMBA', 'KATUMBA', 'NGOY', 'KITOKO'
        ];
        
        $prenoms = [
            'Jean', 'Marie', 'Joseph', 'Joséphine', 'Paul', 'Jeanne', 'Pierre', 'Marguerite',
            'Antoine', 'Thérèse', 'Michel', 'Catherine', 'André', 'Françoise', 'Philippe',
            'Élisabeth', 'Daniel', 'Anne', 'David', 'Martine', 'Emmanuel', 'Angélique',
            'Christian', 'Nathalie', 'Simon', 'Julie', 'Thomas', 'Sabine', 'Pascal', 'Véronique'
        ];
        
        $postnoms = [
            'Wa Kabunda', 'Wa Mambu', 'Wa Tshibola', 'Wa Mulumba', 'Wa Kasongo',
            'Wa Ilunga', 'Wa Mutombo', 'Wa Katembo', 'Wa Mbuyu', 'Wa Kalonji'
        ];
        
        $professions = [
            'Enseignant', 'Commerçant', 'Infirmier', 'Ingénieur', 'Comptable',
            'Agriculteur', 'Chauffeur', 'Secrétaire', 'Avocat', 'Médecin',
            'Entrepreneur', 'Fonctionnaire', 'Étudiant', 'Retraité', 'Sans profession',
            'Coiffeur', 'Menuisier', 'Maçon', 'Couturier', 'Pharmacien'
        ];
        
        $nationalites = ['Congolaise', 'Congolaise'];
        
        $lieuxNaissance = [
            'Kinshasa', 'Lubumbashi', 'Mbuji-Mayi', 'Kananga', 'Kisangani', 'Bukavu',
            'Goma', 'Kolwezi', 'Likasi', 'Tshikapa', 'Mbandaka', 'Beni', 'Butembo',
            'Kindu', 'Matadi', 'Isiro', 'Gemena', 'Bunia', 'Uvira', 'Kalemie'
        ];
        
        $adresses = [
            'Avenue Lumumba', 'Avenue Kabila', 'Avenue de la Révolution', 'Avenue du Commerce',
            'Avenue de l\'Indépendance', 'Boulevard du 30 Juin', 'Avenue des Huileries',
            'Avenue de la Métalco', 'Avenue de la Science', 'Quartier des Plateaux'
        ];
        
        $telephones = [
            '+243 81 123 4567', '+243 82 234 5678', '+243 84 345 6789', '+243 85 456 7890',
            '+243 97 567 8901', '+243 98 678 9012', '+243 99 789 0123', '+243 81 890 1234',
            '+243 82 901 2345', '+243 84 012 3456'
        ];
        
        $etatsCivil = ['célibataire', 'marié', 'divorcé', 'veuf'];
        
        // Récupérer l'utilisateur et l'entité par défaut
        $defaultUserId = DB::table('users')->where('email', 'admin@test.com')->first()->id ?? 1;
        $defaultEntiteId = EntiteAdministrative::where('type', 'province')->first()->id ?? 1;
        
        $personnes = [];
        
        // Générer 200 personnes
        for ($i = 0; $i < 200; $i++) {
            $sexe = rand(0, 1) ? 'M' : 'F';
            $dateNaissance = Carbon::now()->subYears(rand(18, 80))->subDays(rand(0, 365));
            
            // Déterminer la localité en fonction de la province
            $provinceId = $provinces[array_rand($provinces)];
            $territoireId = $territoires ? $territoires[array_rand($territoires)] : null;
            $localiteId = $villes ? $villes[array_rand($villes)] : null;
            
            $personnes[] = [
                'nom' => $noms[array_rand($noms)],
                'prenom' => $prenoms[array_rand($prenoms)],
                'postnom' => rand(0, 1) ? $postnoms[array_rand($postnoms)] : null,
                'sexe' => $sexe,
                'date_naissance' => $dateNaissance,
                'lieu_naissance' => $lieuxNaissance[array_rand($lieuxNaissance)],
                'adresse' => $adresses[array_rand($adresses)] . ' ' . rand(1, 100),
                'profession' => $professions[array_rand($professions)],
                'nationalite' => $nationalites[array_rand($nationalites)],
                'etat_civil' => $etatsCivil[array_rand($etatsCivil)],
                'cin' => 'CIN' . str_pad($i + 1, 8, '0', STR_PAD_LEFT),
                'telephone' => $telephones[array_rand($telephones)],
                'localite_id' => $localiteId,
                'secteur_id' => null,
                'territoire_id' => $territoireId,
                'district_id' => null,
                'province_id' => $provinceId,
                'pere' => rand(0, 1) ? $noms[array_rand($noms)] . ' ' . $prenoms[array_rand($prenoms)] : null,
                'mere' => rand(0, 1) ? $noms[array_rand($noms)] . ' ' . $prenoms[array_rand($prenoms)] : null,
                'photo' => null,
                'user_id' => $defaultUserId,
                'entite_id' => $defaultEntiteId,
                'statut_vie' => rand(0, 100) > 95 ? 'décédé' : 'en vie',
                'created_at' => Carbon::now()->subDays(rand(0, 365)),
                'updated_at' => Carbon::now(),
                'ni' =>  env('Province').'-'.strtoupper(substr(md5(uniqid()), 0, 8))
            ];
            
            // Insert par lots de 50 pour éviter les surcharges mémoire
            if (count($personnes) >= 50) {
                DB::table('personnes')->insert($personnes);
                $personnes = [];
            }
        }
        
        // Insertion du reste
        if (!empty($personnes)) {
            DB::table('personnes')->insert($personnes);
        }
        
        $this->command->info('✅ ' . DB::table('personnes')->count() . ' personnes ajoutées avec succès !');
    }
}