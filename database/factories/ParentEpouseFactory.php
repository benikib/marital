<?php

namespace Database\Factories;

use App\Models\Epouse;
use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\parentEpouse>
 */
class ParentEpouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $province = Province::inRandomOrder()->first();
        $type = fake()->randomElement(['pere', 'mere']);

        return [
            'nom' => fake()->lastName(),
            'prenom' => fake()->firstName($type === 'pere' ? 'male' : 'female'),
            'postnom' => fake()->lastName(),
            'profession' => fake()->jobTitle(),
            'adresse' => fake()->address(),
            'enVie' => fake()->boolean(80), // 80% de chance d'être en vie
            'province' => $province->nom,
            'date_naissance' => fake()->date('Y-m-d', '-40 to -60 years'),
            'lieu_naissance' => fake()->city(),
            'nationalite' => 'Congolaise',
            'type' => $type,
            'epouse_id' => Epouse::factory(),
        ];
    }
}
