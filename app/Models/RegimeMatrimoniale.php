<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimeMatrimoniale extends Model
{
    use HasFactory;

    protected $table = 'regimes_matrimonauxes';

    protected $fillable = [
        'lieu_mariage_coutumier',
        'dotation_coutumier',
        'contrat_id'
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class, 'contrat_id');
    }

    public function mariages()
    {
        return $this->hasMany(mariage::class, 'regimes_matrimonauxe_id');
    }
}
