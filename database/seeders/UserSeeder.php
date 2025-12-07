<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\User;
use App\Models\TypeRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Récupérer les rôles une seule fois
        $adminRole = TypeRole::where('nom', 'admin')->first();
        $moderateurRole = TypeRole::where('nom', 'modérateur')->first();
        $utilisateurRole = TypeRole::where('nom', 'utilisateur')->first();

        // Récupérer les communes spécifiques pour les utilisateurs de test
        $communeCasablanca = Commune::where('nom', 'Ain Sebaa Casa')->first();
        $communeRabat = Commune::where('nom', 'Hassan Rabat')->first();
        $communeParDefaut = Commune::inRandomOrder()->first();

        // Création d'un administrateur
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'type_role_id' => $adminRole->id,
            'commune_id' => $communeCasablanca->id,
        ]);

        // Création d'un modérateur
        User::factory()->create([
            'name' => 'Modérateur',
            'email' => 'moderateur@example.com',
            'type_role_id' => $moderateurRole->id,
            'commune_id' => $communeRabat->id,
        ]);

        // Création de 5 utilisateurs normaux avec des communes aléatoires
        User::factory(5)->create([
            'type_role_id' => $utilisateurRole->id,
        ]);

        // Création de 3 utilisateurs avec une commune par défaut
        for ($i = 0; $i < 3; $i++) {
            User::factory()->create([
                'name' => 'Utilisateur Test ' . ($i + 1),
                'email' => 'test' . ($i + 1) . '@example.com',
                'type_role_id' => $utilisateurRole->id,
                'commune_id' => $communeParDefaut->id,
            ]);
        }
    }
}
