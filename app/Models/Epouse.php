<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epouse extends Model
{
    /** @use HasFactory<\Database\Factories\EpouseFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'postnom', 'profession', 'adresse', 'district', 'province', 'nationalite', 'date_naissance', 'lieu_naissance', 'secteur', 'territoire','url_photo'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parentsEpouse()
    {
        return $this->hasMany(parentEpouse::class ,'epouse_id');
    }
      public function temoins()
    {
        return $this->hasMany(temoinEpouse::class ,'epouse_id');
    }
}
