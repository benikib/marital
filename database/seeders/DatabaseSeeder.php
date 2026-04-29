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

        $this->call([
        EntiteAdministrativeSeeder::class,
      //  PersonnesSeeder::class,
        // Autres seeders...
    ]);
        
        Role::factory()->create([
            'nom' => 'superAdmin',
            'description' => 'SuperAdmin has all permissions.',
        ]);
    

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role_id' => Role::where('nom', 'superAdmin')->first()->id,
            'entite_id' => EntiteAdministrative::where('nom', 'Kinshasa')->first()->id,
             
        ]);

          $this->call([
        
        PersonnesSeeder::class,
        // Autres seeders...
    ]);


    }
}
