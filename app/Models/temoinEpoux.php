<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemoinEpoux extends Model
{
    /** @use HasFactory<\Database\Factories\TemoinEpouxFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'postnom', 'profession', 'adresse', 'etat_civil', 'province', 'nationalite', 'date_naissance', 'lieu_naissance', 'epouxe_id'];
    public function epoux()
    {
        return $this->belongsTo(Epoux::class);
    }
}
