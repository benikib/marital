<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\contrat;

class ContratSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les 4 types de contrats de base
        contrat::factory()->count(4)->create();
    }
}
