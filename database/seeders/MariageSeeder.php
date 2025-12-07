<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mariage;

class MariageSeeder extends Seeder
{
    public function run(): void
    {
        // Créer 15 mariages
        Mariage::factory()->count(15)->create();
    }
}
