<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntiteAdministrative extends Model
{
    protected $table = 'entite_administratives';

    protected $fillable = [
        'nom',
        'type',
        // ajouter d'autres colonnes selon la migration
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'entite_id');
    }
}
