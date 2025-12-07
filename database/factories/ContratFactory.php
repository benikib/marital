<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\contrat>
 */
class ContratFactory extends Factory
{
    protected static $typesContrats = [
        'Contrat de mariage sous régime de communauté réduite aux acquêts',
        'Contrat de mariage sous régime de séparation de biens',
        'Contrat de mariage sous régime de communauté universelle',
        'Contrat de mariage sous régime de participation aux acquêts'
    ];

    protected static $currentIndex = 0;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $typeContrat = self::$typesContrats[self::$currentIndex % count(self::$typesContrats)];
        self::$currentIndex++;

        return [
            'type_contrat' => $typeContrat,
        ];
    }
}
