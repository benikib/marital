<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EntiteAdministrative>
 */
class EntiteAdministrativeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

                'nom' => $this->faker->unique()->city(),
                'type' => $this->faker->randomElement(['Province', 'District', 'Territoire', 'Secteur', 'Localite']),
        ];
    }
}
