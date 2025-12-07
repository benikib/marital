<?php

namespace Database\Factories;

use App\Models\Epouse;
use App\Models\Epoux;
use App\Models\Status;
use App\Models\RegimeMatrimoniale;
use App\Models\AyantDroitCoutinier;
use App\Models\User;
use App\Models\Commune;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mariage>
 */
class MariageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $commune = Commune::inRandomOrder()->first();

        return [
            'lieu_mariage' => fake()->city(),
            'date_mariage' => fake()->date(),
            'status_id' => Status::factory(),
            'regime_matrimonial_id' => RegimeMatrimoniale::factory(),
            'ayant_droit_coutinier_id' => AyantDroitCoutinier::factory(),
            'epouse_id' => Epouse::factory(),
            'epoux_id' => Epoux::factory(),
            'user_id' => $user->id,
            'commune_id' => $commune->id,
        ];
    }
}
