<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mariage extends Model
{
    use HasFactory;

    protected $table = 'mariages';

    protected $fillable = [
        'epoux_id',
        'epouse_id',
        'regime_id',
        'statut_id',
        'date_mariage',
        'lieu_mariage',
        'empreinte_epoux',
        'empreinte_epouse',
        'photo_epoux',
        'photo_epouse',
        'photo_couple',
        'etat_civil_epoux',
        'etat_civil_epouse',
        'user_id',
        'entite_id',
         'num_acte',
    ];

    protected $casts = [
        'date_mariage' => 'date',
    ];

    public function epoux()
    {
        return $this->belongsTo(Personne::class, 'epoux_id');
    }

    public function epouse()
    {
        return $this->belongsTo(Personne::class, 'epouse_id');
    }

    public function regime()
    {
        return $this->belongsTo(RegimeMatrimonial::class, 'regime_id');
    }

    public function statut()
    {
        return $this->belongsTo(StatutMariage::class, 'statut_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entite()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'entite_id');
    }

    public function temoins()
    {
        return $this->hasMany(MariageTemoin::class, 'mariage_id');
    }

    public function parents()
    {
        return $this->hasMany(MariageParent::class, 'mariage_id');
    }



}
