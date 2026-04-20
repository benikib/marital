<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntiteAdministrative extends Model
{
    use HasFactory;

    protected $table = 'entite_administratives';

    protected $fillable = [
        'nom',
        'type',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'entite_id');
    }

    public function mariages()
    {
        return $this->hasMany(Mariage::class, 'entite_id');
    }
}
