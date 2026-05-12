<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompositionFamiliale extends Model
{
    use HasFactory;

    protected $table = 'composition_familiales';

    protected $fillable = [

        'soussignataire',
        'nombre_enfants',
        'mariage_id',
        'user_id',
        'entite_id',
        'personne_id',
        'documents',
        'num_acte',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function mariage()
    {
        return $this->belongsTo(Mariage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entite()
    {
        return $this->belongsTo(EntiteAdministrative::class);
    }

    public function personne()
    {
        return $this->belongsTo(Personne::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Enfants
    |--------------------------------------------------------------------------
    */

    public function enfants()
    {
        return $this->belongsToMany(
            Personne::class,
            'composition_familiale_personnes',
            'composition_familiale_id',
            'personne_id'
        );
    }
}