<?php

namespace Database\Seeders;

use App\Models\AyantDroitCoutinier;
use Illuminate\Database\Seeder;

class AyantDroitCoutinierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AyantDroitCoutinier::factory(10)->create();
    }
}
