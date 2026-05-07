<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MariageTemoin extends Model
{
    use HasFactory;

    protected $table = 'mariage_temoins';

    public $timestamps = false;

    protected $fillable = [
        'mariage_id',
        'personne_id',
        'role',
    ];

    public function mariage()
    {
        return $this->belongsTo(Mariage::class, 'mariage_id');
    }

    public function personne()
    {
        return $this->belongsTo(Personne::class, 'personne_id');
    }
}
