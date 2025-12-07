<?php

namespace Database\Seeders;

use App\Models\Epoux;
use App\Models\TemoinEpoux;
use Illuminate\Database\Seeder;

class TemoinEpouxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pour chaque époux, créer 2 témoins
        Epoux::all()->each(function ($epoux) {
            TemoinEpoux::factory()->count(2)->create([
                'epouxe_id' => $epoux->id
            ]);
        });
    }
}
