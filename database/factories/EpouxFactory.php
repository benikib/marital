<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Epoux>
 */
class EpouxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstNameMale(),
            'postnom' => fake()->lastName(),
            'profession' => fake()->jobTitle(),
            'adresse' => fake()->address(),
            'district' => fake()->city(),
            'province' => fake()->randomElement(['Kinshasa', 'Kongo Central', 'Kwango', 'Kwilu', 'Mai-Ndombe', 'Equateur', 'Nord-Ubangi', 'Sud-Ubangi', 'Mongala', 'Tshuapa', 'Tshopo', 'Bas-Uele', 'Haut-Uele', 'Ituri', 'Nord-Kivu', 'Sud-Kivu', 'Maniema', 'Sankuru', 'Kasai', 'Kasai Central', 'Kasai Oriental', 'Lomami', 'Haut-Lomami', 'Lualaba', 'Haut-Katanga', 'Tanganyika']),
            'nationalite' => fake()->randomElement(['Congolais', 'Congolais (RDC)', 'Étranger']),
            'date_naissance' => fake()->date(),
            'lieu_naissance' => fake()->city(),
            'secteur' => fake()->city(),
            'territoire' => fake()->city(),
            'url_photo' => 'https://via.placeholder.com/640x480.png/000088?text=people+sit',
        ];
    }
}
