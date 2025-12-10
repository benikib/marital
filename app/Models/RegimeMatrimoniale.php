<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimeMatrimoniale extends Model
{
    use HasFactory;

    protected $table = 'regimes_matrimonauxes';

    protected $fillable = [
        'lieu_mariage_cutinier',
        'dotation_cutinier',
        'contrat_id'
    ];

    public function contrat()
    {
        return $this->belongsTo(contrat::class, 'contrat_id');
    }

    public function mariages()
    {
        return $this->hasMany(Mariage::class, 'regimes_matrimonauxe_id');
    }
}
