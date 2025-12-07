<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Epouse;
use Faker\Factory as Faker;

class EpouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Photos fictives pour les épouses
        $photos = [
            'https://randomuser.me/api/portraits/women/1.jpg',
            'https://randomuser.me/api/portraits/women/2.jpg',
            'https://randomuser.me/api/portraits/women/3.jpg',
            'https://randomuser.me/api/portraits/women/4.jpg',
            'https://randomuser.me/api/portraits/women/5.jpg',
        ];

        // Créer 10 épouses avec des données fictives
        for ($i = 0; $i < 10; $i++) {
            Epouse::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstNameFemale,
                'postnom' => $faker->lastName,
                'profession' => $faker->jobTitle,
                'adresse' => $faker->address,
                'district' => $faker->city,
                'province' => $faker->randomElement(['Kinshasa', 'Lubumbashi', 'Goma', 'Kisangani', 'Matadi']),
                'nationalite' => 'Congolaise',
                'date_naissance' => $faker->date('Y-m-d', '-20 years'),
                'lieu_naissance' => $faker->city,
                'secteur' => $faker->city,
                'territoire' => $faker->city,
                'url_photo' => $faker->randomElement($photos),
            ]);
        }
    }
}
