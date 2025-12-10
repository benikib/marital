<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\province>
 */
class ProvinceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provinces = [
            'Casablanca',
            'Rabat',
            'Marrakech',
            'Fès',
            'Tanger',
            'Agadir',
            'Meknès',
            'Oujda',
            'Kénitra',
            'Tétouan',
            'Salé',
            'Nador',
            'Mohammedia',
            'El Jadida',
            'Béni Mellal',
            'Khouribga',
            'Taza',
            'Al Hoceïma',
            'Essaouira',
            'Tiznit',
            'Larache',
            'Ksar El Kébir',
            'Settat',
            'Berrechid',
            'Khemisset',
            'Taourirt',
            'Errachidia',
            'Ouarzazate',
            'Safi',
            'Youssoufia',
            'Dakhla',
            'Laâyoune',
            'Guelmim',
            'Tan-Tan',
            'Sidi Ifni',
            'Taroudant',
            'Ouezzane',
            'Chefchaouen',
            'Ifrane',
            'Midelt',
            'Azrou',
            'Khenifra',
            'Beni Tadjit',
            'Figuig',
            'Berkane'
        ];

        return [
            'nom' => fake()->unique()->randomElement($provinces),
        ];
    }
}
