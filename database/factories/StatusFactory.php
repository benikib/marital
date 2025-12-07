<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected static $statuts = [
        'En cours de traitement',
        'Validé',
        'Rejeté',
        'En attente de documents',
        'Annulé'
    ];

    protected static $currentIndex = 0;

    public function definition(): array
    {
        $statut = self::$statuts[self::$currentIndex % count(self::$statuts)];
        self::$currentIndex++;

        return [
            'nom' => $statut,
        ];
    }
}
