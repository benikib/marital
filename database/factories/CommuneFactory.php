<?php

namespace Database\Factories;

use App\Models\province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commune>
 */
class CommuneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Liste de préfixes et suffixes communs pour les noms de communes marocaines
        $prefixes = ['Beni', 'Sidi', 'El', 'Dar', 'Oulad', 'Ain', 'Bir', 'Douar', 'Ksar', 'Moulay'];
        $suffixes = ['Salam', 'Driss', 'Brahim', 'Mohammed', 'Ali', 'Hassan', 'Ahmed', 'Youssef', 'Ibrahim', 'Rahman'];

        // Générer un nom de commune aléatoire
        $nom = fake()->randomElement($prefixes) . ' ' . fake()->randomElement($suffixes);

        return [
            'nom' => $nom,
            'province_id' => Province::inRandomOrder()->first()->id,
        ];
    }
}
