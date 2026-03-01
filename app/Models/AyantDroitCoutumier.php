<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AyantDroitCoutumier extends Model
{
    use HasFactory;

    protected $table = 'ayant_droit_coutumiers';

    protected $fillable = [
        'nom',
        'prenom',
        'postnom',
        'profession',
        'adresse',
        'nationalite',
        'province',
        'date_naissance',
        'lieu_naissance',
        'enVie',
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'enVie' => 'boolean'
    ];

    public function epoux()
    {
        return $this->belongsTo(Epoux::class);
    }

    public function epouse()
    {
        return $this->belongsTo(Epouse::class);
    }

    public function mariages()
    {
        return $this->hasMany(Mariage::class);
    }
}
