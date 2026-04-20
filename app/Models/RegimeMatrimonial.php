<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimeMatrimonial extends Model
{
    use HasFactory;

    protected $table = 'regimes_matrimoniaux';

    public $timestamps = false;

    protected $fillable = [
        'dotation_coutumiere',
        'contrat_id',
    ];

    public function contrat()
    {
        return $this->belongsTo(Contrat::class, 'contrat_id');
    }

    public function mariages()
    {
        return $this->hasMany(Mariage::class, 'regime_id');
    }
}
