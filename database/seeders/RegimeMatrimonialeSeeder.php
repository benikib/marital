<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RegimeMatrimoniale;

class RegimeMatrimonialeSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 10 régimes matrimoniaux
        RegimeMatrimoniale::factory()->count(10)->create();
    }
}
