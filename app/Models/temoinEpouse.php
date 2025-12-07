<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemoinEpouse extends Model
{
    /** @use HasFactory<\Database\Factories\TemoinEpouseFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'postnom', 'profession', 'adresse', 'etat_civil', 'province', 'nationalite', 'date_naissance', 'lieu_naissance', 'epouse_id'];
    public function epouse()
    {
        return $this->belongsTo(Epouse::class);
    }
}
