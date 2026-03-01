<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    /** @use HasFactory<\Database\Factories\ContratFactory> */
    use HasFactory;

    protected $fillable = [
        'type_contrat'
    ];

    public function regimesMatrimoniaux()
    {
        return $this->hasMany(RegimeMatrimoniale::class, 'contrat_id');
    }
}
