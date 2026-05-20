<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;

class StatsGlobalSheet implements FromArray, WithTitle
{
    protected $stats;

    public function __construct($stats)
    {
        $this->stats = $stats;
    }

    public function array(): array
    {
        return [
            ['Type', 'Total'],
            ['Mariages', $this->stats['total_mariages']],
            ['Naissances', $this->stats['total_naissances']],
            ['Décès', $this->stats['total_deces']],
            ['Célibats', $this->stats['total_celibats']],
            ['Résidences', $this->stats['total_residences']],
            ['Veuvages', $this->stats['total_veuvages']],
            ['Nationalités', $this->stats['total_nationalites']],
            ['Agents', $this->stats['total_agents']],
        ];
    }

    public function title(): string
    {
        return 'Statistiques Globales';
    }
}