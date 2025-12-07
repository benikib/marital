<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run(): void
    {
        // Créer les 5 statuts de base
        Status::factory()->count(5)->create();
    }
}
