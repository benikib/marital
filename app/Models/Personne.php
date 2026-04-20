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
}
