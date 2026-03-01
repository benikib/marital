<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parentEpoux extends Model
{
    /** @use HasFactory<\Database\Factories\ParentEpouxFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'postnom', 'profession', 'adresse', 'enVie', 'province', 'date_naissance', 'lieu_naissance', 'nationalite', 'type', 'epouxe_id'];
    public function epoux()
    {
        return $this->hasMany(Epoux::class);
    }
}
