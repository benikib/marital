<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contrat;

class RegimeMatrimonialeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lieu_mariage_cutinier' => $this->faker->city(),
            'dotation_cutinier' => $this->faker->numberBetween(100000, 1000000),
            'contrat_id' => Contrat::factory(),
        ];
    }
}
