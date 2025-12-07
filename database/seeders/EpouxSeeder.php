<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Epoux;
use Faker\Factory as Faker;

class EpouxSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('fr_FR');

        // Photos fictives pour les époux
        $photos = [
            'https://randomuser.me/api/portraits/men/1.jpg',
            'https://randomuser.me/api/portraits/men/2.jpg',
            'https://randomuser.me/api/portraits/men/3.jpg',
            'https://randomuser.me/api/portraits/men/4.jpg',
            'https://randomuser.me/api/portraits/men/5.jpg',
        ];

        // Créer 10 époux avec des données fictives
        for ($i = 0; $i < 10; $i++) {
            Epoux::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstNameMale,
                'postnom' => $faker->lastName,
                'profession' => $faker->jobTitle,
                'adresse' => $faker->address,
                'district' => $faker->city,
                'province' => $faker->randomElement(['Kinshasa', 'Lubumbashi', 'Goma', 'Kisangani', 'Matadi']),
                'nationalite' => 'Congolais',
                'date_naissance' => $faker->date('Y-m-d', '-20 years'),
                'lieu_naissance' => $faker->city,
                'secteur' => $faker->city,
                'territoire' => $faker->city,
                'url_photo' => $faker->randomElement($photos),
            ]);
        }
    }
}
