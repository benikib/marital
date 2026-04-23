<?php

namespace Database\Seeders;

use App\Models\EntiteAdministrative;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        Role::factory()->create([
            'nom' => 'superAdmin',
            'description' => 'SuperAdmin has all permissions.',
        ]);
        EntiteAdministrative::factory()->create([
            'nom' => 'Kinshasa',
            'type' => 'Province',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role_id' => Role::where('nom', 'superAdmin')->first()->id,
            'entite_id' => EntiteAdministrative::where('nom', 'Kinshasa')->first()->id,
             
        ]);
    }
}
