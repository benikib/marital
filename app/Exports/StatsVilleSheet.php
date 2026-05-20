<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class StatsVilleSheet implements FromArray, WithTitle
{
    protected $statsParVille;

    public function __construct($statsParVille)
    {
        $this->statsParVille = $statsParVille;
    }

    public function array(): array
    {
        $data = [
            [
                'Ville',
                'Mariages',
                'Naissances',
                'Décès',
                'Célibats',
                'Résidences',
                'Veuvages',
                'Nationalités',
                'Inhumations',
                'Agents',
                'Total'
            ]
        ];

        foreach ($this->statsParVille as $ville) {
            $data[] = [
                $ville['ville'],
                $ville['mariages'],
                $ville['naissances'],
                $ville['deces'],
                $ville['celibats'],
                $ville['residences'],
                $ville['veuvages'],
                $ville['nationalites'],
                $ville['inhumations'],
                $ville['agents'],
                $ville['total'],
            ];
        }

        return $data;
    }

    public function title(): string
    {
        return 'Par Ville';
    }
}