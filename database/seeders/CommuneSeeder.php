<?php

namespace Database\Seeders;

use App\Models\commune;
use App\Models\province;
use Illuminate\Database\Seeder;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des communes principales par province avec des noms uniques
        $communes = [
            'Kinshasa' => [
                  'Gombe',
    'Barumbu',
    'Kinshasa',
    'Kintambo',
    'Lingwala',
    'Mont Ngafula',
    'N’Djili',
    'Ngaba',
    'Ngaliema',
    'Kalamu',
    'Kasa-Vubu',
    'Kimbanseke',
    'Kisenso',
    'Lemba',
    'Limete',
    'Makala',
    'Masina',
    'Matete',
    'Mont Amba',
    'Ndjili',
    'Nsele',
    'Selembao',
    'Tshangu',
            ],
            
        ];

        foreach ($communes as $provinceName => $communeNames) {
            $province = province::where('nom', $provinceName)->first();

            if ($province) {
                foreach ($communeNames as $communeName) {
                    // Vérifier si la commune existe déjà avant de la créer
                    if (!commune::where('nom', $communeName)->exists()) {
                        commune::create([
                            'nom' => $communeName,
                            'province_id' => $province->id
                        ]);
                    }
                }
            }
        }
    }
}
