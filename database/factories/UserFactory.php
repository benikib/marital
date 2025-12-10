<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\TypeRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'type_role_id' => typeRole::where('nom', 'utilisateur')->first()->id,
            'commune_id' => Commune::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Créer un utilisateur sans commune assignée.
     * Note: Cette méthode ne devrait être utilisée que si la colonne commune_id est nullable.
     */
    public function sansCommune(): static
    {
        return $this->state(fn(array $attributes) => [
            'commune_id' => null,
        ]);
    }
}
