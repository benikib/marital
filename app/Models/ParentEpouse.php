<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parentEpouse extends Model
{
    /** @use HasFactory<\Database\Factories\ParentEpouseFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'postnom', 'profession', 'adresse', 'enVie', 'province', 'date_naissance', 'lieu_naissance', 'nationalite', 'type', 'epouse_id'];
    public function epouse()
    {
        return $this->hasMany(Epouse::class);
    }
}
