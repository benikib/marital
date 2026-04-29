<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EntiteAdministrativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vider la table avant de remplir (optionnel)
        Schema::disableForeignKeyConstraints();
        DB::table('entite_administratives')->truncate();
        Schema::enableForeignKeyConstraints();

        // Structure: [nom, type, parent_id]
        $entites = [
            // ========== PROVINCES (Niveau 1 - parent_id = null) ==========
            ['Kinshasa', 'province', null],
            ['Kongo Central', 'province', null],
            ['Kwango', 'province', null],
            ['Kwilu', 'province', null],
            ['Mai-Ndombe', 'province', null],
            ['Équateur', 'province', null],
            ['Mongala', 'province', null],
            ['Nord-Ubangi', 'province', null],
            ['Sud-Ubangi', 'province', null],
            ['Tshuapa', 'province', null],
            ['Bas-Uele', 'province', null],
            ['Haut-Uele', 'province', null],
            ['Ituri', 'province', null],
            ['Tshopo', 'province', null],
            ['Nord-Kivu', 'province', null],
            ['Sud-Kivu', 'province', null],
            ['Maniema', 'province', null],
            ['Kasai', 'province', null],
            ['Kasai-Central', 'province', null],
            ['Kasai-Oriental', 'province', null],
            ['Lomami', 'province', null],
            ['Sankuru', 'province', null],
            ['Haut-Lomami', 'province', null],
            ['Haut-Katanga', 'province', null],
            ['Lualaba', 'province', null],
            ['Tanganyika', 'province', null],

            // ========== VILLES PROVINCIALES ==========
            // Kinshasa
            ['Kinshasa', 'ville', 1], // ID 1 = Kinshasa province
            
            // Kongo Central
            ['Matadi', 'ville', 2], // ID 2 = Kongo Central
            ['Boma', 'ville', 2],
            ['Muanda', 'ville', 2],
            
            // Kwango
            ['Kenge', 'ville', 3], // ID 3 = Kwango
            
            // Kwilu
            ['Bandundu', 'ville', 4], // ID 4 = Kwilu
            ['Kikwit', 'ville', 4],
            
            // Mai-Ndombe
            ['Inongo', 'ville', 5], // ID 5 = Mai-Ndombe
            
            // Équateur
            ['Mbandaka', 'ville', 6], // ID 6 = Équateur
            
            // Mongala
            ['Lisala', 'ville', 7], // ID 7 = Mongala
            
            // Nord-Ubangi
            ['Gbadolite', 'ville', 8], // ID 8 = Nord-Ubangi
            
            // Sud-Ubangi
            ['Gemena', 'ville', 9], // ID 9 = Sud-Ubangi
            
            // Tshuapa
            ['Boende', 'ville', 10], // ID 10 = Tshuapa
            
            // Bas-Uele
            ['Buta', 'ville', 11], // ID 11 = Bas-Uele
            
            // Haut-Uele
            ['Isiro', 'ville', 12], // ID 12 = Haut-Uele
            
            // Ituri
            ['Bunia', 'ville', 13], // ID 13 = Ituri
            
            // Tshopo
            ['Kisangani', 'ville', 14], // ID 14 = Tshopo
            
            // Nord-Kivu
            ['Goma', 'ville', 15], // ID 15 = Nord-Kivu
            ['Beni', 'ville', 15],
            ['Butembo', 'ville', 15],
            
            // Sud-Kivu
            ['Bukavu', 'ville', 16], // ID 16 = Sud-Kivu
            ['Uvira', 'ville', 16],
            ['Baraka', 'ville', 16],
            
            // Maniema
            ['Kindu', 'ville', 17], // ID 17 = Maniema
            
            // Kasai
            ['Tshikapa', 'ville', 18], // ID 18 = Kasai
            
            // Kasai-Central
            ['Kananga', 'ville', 19], // ID 19 = Kasai-Central
            
            // Kasai-Oriental
            ['Mbuji-Mayi', 'ville', 20], // ID 20 = Kasai-Oriental
            ['Mwene-Ditu', 'ville', 20],
            
            // Lomami
            ['Kabinda', 'ville', 21], // ID 21 = Lomami
            
            // Sankuru
            ['Lusambo', 'ville', 22], // ID 22 = Sankuru
            
            // Haut-Lomami
            ['Kamina', 'ville', 23], // ID 23 = Haut-Lomami
            
            // Haut-Katanga
            ['Lubumbashi', 'ville', 24], // ID 24 = Haut-Katanga
            ['Likasi', 'ville', 24],
            ['Kolwezi', 'ville', 24],
            
            // Lualaba
            ['Kolwezi', 'ville', 25], // ID 25 = Lualaba
            
            // Tanganyika
            ['Kalemie', 'ville', 26], // ID 26 = Tanganyika

            // ========== TERRITOIRES (Niveau 2 - parent_id = id des villes ou provinces) ==========
            
            // Territoires d'Ituri
            ['Aru', 'territoire', 13],
            ['Djugu', 'territoire', 13],
            ['Irumu', 'territoire', 13],
            ['Mahagi', 'territoire', 13],
            ['Mambasa', 'territoire', 13],
            
            // Territoires du Nord-Kivu
            ['Beni', 'territoire', 15],
            ['Lubero', 'territoire', 15],
            ['Masisi', 'territoire', 15],
            ['Nyiragongo', 'territoire', 15],
            ['Rutshuru', 'territoire', 15],
            ['Walikale', 'territoire', 15],
            
            // Territoires du Sud-Kivu
            ['Fizi', 'territoire', 16],
            ['Idjwi', 'territoire', 16],
            ['Kabare', 'territoire', 16],
            ['Kalehe', 'territoire', 16],
            ['Mwenga', 'territoire', 16],
            ['Shabunda', 'territoire', 16],
            ['Uvira', 'territoire', 16],
            ['Walungu', 'territoire', 16],
            
            // Territoires du Tanganyika
            ['Kabalo', 'territoire', 26],
            ['Kalemie', 'territoire', 26],
            ['Kongolo', 'territoire', 26],
            ['Manono', 'territoire', 26],
            ['Moba', 'territoire', 26],
            ['Nyunzu', 'territoire', 26],
            
            // Territoires du Haut-Katanga
            ['Kambove', 'territoire', 24],
            ['Kipushi', 'territoire', 24],
            ['Lubumbashi', 'territoire', 24],
            ['Mutshatsha', 'territoire', 24],
            ['Sakania', 'territoire', 24],
            
            // Territoires du Lualaba
            ['Dilolo', 'territoire', 25],
            ['Kapanga', 'territoire', 25],
            ['Mutshatsha', 'territoire', 25],
            
            // Territoires de l'Équateur
            ['Bikoro', 'territoire', 6],
            ['Bolomba', 'territoire', 6],
            ['Bomongo', 'territoire', 6],
            ['Ingende', 'territoire', 6],
            ['Lukolela', 'territoire', 6],
            ['Mbandaka', 'territoire', 6],
            
            // Territoires du Kongo Central
            ['Kasangulu', 'territoire', 2],
            ['Kimvula', 'territoire', 2],
            ['Lukula', 'territoire', 2],
            ['Madimba', 'territoire', 2],
            ['Mbanza-Ngungu', 'territoire', 2],
            ['Seke-Banza', 'territoire', 2],
            ['Songololo', 'territoire', 2],
            ['Tshela', 'territoire', 2],
            
            // Territoires du Kwango
            ['Feshi', 'territoire', 3],
            ['Kahemba', 'territoire', 3],
            ['Kasongo-Lunda', 'territoire', 3],
            ['Kenge', 'territoire', 3],
            ['Popokabaka', 'territoire', 3],
            
            // Territoires de la Tshopo
            ['Bafwasende', 'territoire', 14],
            ['Banalia', 'territoire', 14],
            ['Basoko', 'territoire', 14],
            ['Isangi', 'territoire', 14],
            ['Opala', 'territoire', 14],
            ['Ubundu', 'territoire', 14],
            ['Yahuma', 'territoire', 14],
            ['Yangambi', 'territoire', 14],
        ];

        // Insertion des entités
        foreach ($entites as $entite) {
            $existingId = DB::table('entite_administratives')
                ->where('nom', $entite[0])
                ->where('type', $entite[1])
                ->where('parent_id', $entite[2])
                ->first();

            if (!$existingId) {
                DB::table('entite_administratives')->insert([
                    'nom' => $entite[0],
                    'type' => $entite[1],
                    'parent_id' => $entite[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('✅ Entités administratives de la RDC ajoutées avec succès !');
        $this->command->info('📊 Total: ' . DB::table('entite_administratives')->count() . ' entités');
    }
}