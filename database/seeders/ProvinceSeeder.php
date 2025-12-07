<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Liste des principales provinces du Maroc
        $provinces = [
            ['nom' => 'Casablanca'],
            ['nom' => 'Rabat'],
            ['nom' => 'Marrakech'],
            ['nom' => 'Fès'],
            ['nom' => 'Tanger'],
            ['nom' => 'Agadir'],
            ['nom' => 'Meknès'],
            ['nom' => 'Oujda'],
            ['nom' => 'Kénitra'],
            ['nom' => 'Tétouan'],
            ['nom' => 'Salé'],
            ['nom' => 'Nador'],
            ['nom' => 'Mohammedia'],
            ['nom' => 'El Jadida'],
            ['nom' => 'Béni Mellal'],
            ['nom' => 'Khouribga'],
            ['nom' => 'Taza'],
            ['nom' => 'Al Hoceïma'],
            ['nom' => 'Essaouira'],
            ['nom' => 'Tiznit'],
            ['nom' => 'Larache'],
            ['nom' => 'Ksar El Kébir'],
            ['nom' => 'Settat'],
            ['nom' => 'Berrechid'],
            ['nom' => 'Khemisset'],
            ['nom' => 'Taourirt'],
            ['nom' => 'Errachidia'],
            ['nom' => 'Ouarzazate'],
            ['nom' => 'Safi'],
            ['nom' => 'Youssoufia'],
            ['nom' => 'Dakhla'],
            ['nom' => 'Laâyoune'],
            ['nom' => 'Guelmim'],
            ['nom' => 'Tan-Tan'],
            ['nom' => 'Sidi Ifni'],
            ['nom' => 'Taroudant'],
            ['nom' => 'Ouezzane'],
            ['nom' => 'Chefchaouen'],
            ['nom' => 'Ifrane'],
            ['nom' => 'Midelt'],
            ['nom' => 'Azrou'],
            ['nom' => 'Khenifra'],
            ['nom' => 'Beni Tadjit'],
            ['nom' => 'Figuig'],
            ['nom' => 'Berkane']
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
