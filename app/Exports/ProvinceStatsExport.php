<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProvinceStatsExport implements WithMultipleSheets
{
    protected $stats;
    protected $statsParVille;

    public function __construct($stats, $statsParVille)
    {
        $this->stats = $stats;
        $this->statsParVille = $statsParVille;
    }

    public function sheets(): array
    {
        return [
            new StatsGlobalSheet($this->stats),
            new StatsVilleSheet($this->statsParVille),
        ];
    }
}