<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contrat;

class ContratSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les 4 types de contrats de base
        Contrat::factory()->count(4)->create();
    }
}
