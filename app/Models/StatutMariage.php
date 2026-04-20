<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatutMariage extends Model
{
    use HasFactory;

    protected $table = 'statuts_mariage';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];

    public function mariages()
    {
        return $this->hasMany(Mariage::class, 'statut_id');
    }
}
