<?php

namespace Database\Seeders;

use App\Models\Epoux;
use App\Models\ParentEpoux;
use Illuminate\Database\Seeder;

class ParentEpouxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     // Pour chaque époux, créer ses parents (père et mère)
    //     Epoux::all()->each(function ($epoux) {
    //         // Créer le père
    //         ParentEpoux::factory()->create([
    //             'epouxe_id' => $epoux->id,
    //             'type' => 'pere'
    //         ]);

    //         // Créer la mère
    //         ParentEpoux::factory()->create([
    //             'epouxe_id' => $epoux->id,
    //             'type' => 'mere'
    //         ]);
    //     });
    // }
}
