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
           
    ['nom' => 'Kinshasa'],
    ['nom' => 'Kongo-Central'],
    ['nom' => 'Kwango'],
    ['nom' => 'Kwilu'],
    ['nom' => 'Mai-Ndombe'],
    ['nom' => 'Kasaï'],
    ['nom' => 'Kasaï-Central'],
    ['nom' => 'Kasaï-Oriental'],
    ['nom' => 'Lomami'],
    ['nom' => 'Haut-Lomami'],
    ['nom' => 'Tanganyika'],
    ['nom' => 'Haut-Katanga'],
    ['nom' => 'Haut-Kasaï'],
    ['nom' => 'Sankuru'],
    ['nom' => 'Maniema'],
    ['nom' => 'Nord-Kivu'],
    ['nom' => 'Sud-Kivu'],
    ['nom' => 'Ituri'],
    ['nom' => 'Tshopo'],
    ['nom' => 'Haut-Uélé'],
    ['nom' => 'Bas-Uélé'],
    ['nom' => 'Mongala'],
    ['nom' => 'Nord-Ubangi'],
    ['nom' => 'Sud-Ubangi'],
    ['nom' => 'Équateur'],
    ['nom' => 'Lualaba'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
