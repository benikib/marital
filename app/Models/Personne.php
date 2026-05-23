<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    protected $table = 'personnes';

    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'date_naissance',
        'lieu_naissance',
        'adresse',
        'profession',
        'nationalite',
        'photo',
        'pere',
        'mere',
        'cin',
        'telephone',
        'localite_id',
        'secteur_id',
        'territoire_id',
        'district_id',
        'province_id',
        'user_id',
        'entite_id',
        'statut_vie',
        'documents',
        'postnom',
        'etat_civil',
        'ni',
        
        

    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function mariagesAsEpoux()
    {
        return $this->hasMany(Mariage::class, 'epoux_id');
    }

    public function mariagesAsEpouse()
    {
        return $this->hasMany(Mariage::class, 'epouse_id');
    }

    public function temoignages()
    {
        return $this->hasMany(MariageTemoin::class, 'personne_id');
    }

    public function parentages()
    {
        return $this->hasMany(MariageParent::class, 'personne_id');
    }

       public function mariagesEpoux()
{
    return $this->hasMany(Mariage::class, 'epoux_id');
}

    public function mariagesEpouse()
{
    return $this->hasMany(Mariage::class, 'epouse_id');
}

public function localite()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'localite_id');
    }

    public function secteur()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'secteur_id');
    }

    public function territoire()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'territoire_id');
    }

    public function district()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'district_id');
    }

    public function province()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'province_id');
    }
    public function inhumations()
    {
        return $this->hasMany(Inhumation::class);   
    }

    public function entite()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'entite_id');
    }

     public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function celibats()
    {
        return $this->hasMany(Celibat::class);   
    }
    public function compositionsFamiliales()
{
    return $this->belongsToMany(
        CompositionFamiliale::class,
        'composition_familiale_personnes',
        'personne_id',
        'composition_familiale_id'
    );
}
}
