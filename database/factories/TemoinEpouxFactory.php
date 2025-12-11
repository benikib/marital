<?php

namespace Database\Factories;

use App\Models\Epoux;
use App\Models\province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\temoinEpoux>
 */
class TemoinEpouxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province = province::inRandomOrder()->first();
        $etatCivil = fake()->randomElement(['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf(ve)']);

        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName(),
            'postnom' => fake()->lastName(),
            'profession' => fake()->jobTitle(),
            'adresse' => fake()->address(),
            'etat_civil' => $etatCivil,
            'province' => $province->nom,
            'nationalite' => 'Congolaise',
            'date_naissance' => fake()->date('Y-m-d', '-18 years'),
            'lieu_naissance' => fake()->city(),
            'epouxe_id' => Epoux::factory(),
        ];
    }
}
