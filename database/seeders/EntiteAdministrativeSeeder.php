<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntiteAdministrativeSeeder extends Seeder
{
    public function run(): void
    {
        // Provinces
        $kinshasa = DB::table('entite_administratives')->insertGetId([
            'nom' => 'Kinshasa',
            'type' => 'province',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $kongoCentral = DB::table('entite_administratives')->insertGetId([
            'nom' => 'Kongo Central',
            'type' => 'province',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Ville de Kinshasa
        $villeKin = DB::table('entite_administratives')->insertGetId([
            'nom' => 'Ville de Kinshasa',
            'type' => 'ville',
            'parent_id' => $kinshasa,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Territoires
        $lukunga = DB::table('entite_administratives')->insertGetId([
            'nom' => 'Lukunga',
            'type' => 'territoire',
            'parent_id' => $villeKin,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $matadi = DB::table('entite_administratives')->insertGetId([
            'nom' => 'Matadi',
            'type' => 'territoire',
            'parent_id' => $kongoCentral, // territoire rural
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Communes
        DB::table('entite_administratives')->insert([
            [
                'nom' => 'Gombe',
                'type' => 'commune',
                'parent_id' => $lukunga,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Kintambo',
                'type' => 'commune',
                'parent_id' => $lukunga,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Secteur (exemple rural)
        DB::table('entite_administratives')->insert([
            'nom' => 'Secteur de Tshela',
            'type' => 'secteur',
            'parent_id' => $matadi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
