<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Naissance extends Model
{
   protected $fillable = [
        'soussignataire',
        'documents',
        'personne_id',
        'user_id',
        'entite_id',
        
        
    ];

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function entite()
    {
        return $this->belongsTo(EntiteAdministrative::class);
    }
}
