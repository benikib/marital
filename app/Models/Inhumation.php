<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inhumation extends Model
{
    protected $fillable = [
        'soussignataire',
        'documents',
        'personne_id',
        'user_id',
        'entite_id',
        'residence_temporaire',
        'lieu_inhumation',
        'date_inhumation',
        'cimetiere',
        'num_acte',
        
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
