<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epoux extends Model
{
    /** @use HasFactory<\Database\Factories\EpouxFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'postnom', 'profession', 'adresse', 'district', 'province', 'nationalite', 'date_naissance', 'lieu_naissance', 'secteur', 'territoire','url_photo'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parentEpoux()
    {
        return $this->hasMany(ParentEpoux::class, 'id');
    }
    // Dans app/Models/Epoux.php
public function parentsEpoux()
{
    return $this->hasMany(ParentEpoux::class,'epouxe_id');
}

public function temoins()
{
    return $this->hasMany(TemoinEpoux::class,'epouxe_id');
}
}
