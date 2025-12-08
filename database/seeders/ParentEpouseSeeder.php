<?php

namespace Database\Seeders;

use App\Models\Epouse;
use App\Models\ParentEpouse;
use Illuminate\Database\Seeder;

class ParentEpouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     // Pour chaque épouse, créer ses parents (père et mère)
    //     Epouse::all()->each(function ($epouse) {
    //         // Créer le père
    //         ParentEpouse::factory()->create([
    //             'epouse_id' => $epouse->id,
    //             'type' => 'pere'
    //         ]);

    //         // Créer la mère
    //         ParentEpouse::factory()->create([
    //             'epouse_id' => $epouse->id,
    //             'type' => 'mere'
    //         ]);
    //     });
    // }
}
