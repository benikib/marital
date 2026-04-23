<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationalite extends Model
{
    protected $fillable = [

        'dont_cout',
        'documents',
        'quittance',
        'soussignataire',
        'personne_id',
        'user_id',  
        'entite_id',
        'nationalite',
        'residence',
        'motif',
        'nationalite_pere',
        'nationalite_mere',

        
        
    ] ;

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
