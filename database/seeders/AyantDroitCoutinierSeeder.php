<?php

namespace Database\Seeders;

use App\Models\AyantDroitCoutumier;
use Illuminate\Database\Seeder;

class AyantDroitCoutumierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AyantDroitCoutumier::factory(10)->create();
    }
}
