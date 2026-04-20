<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;

    protected $table = 'contrats';

    public $timestamps = false;

    protected $fillable = [
        'nom',
    ];

    public function regimesMatrimoniaux()
    {
        return $this->hasMany(RegimeMatrimonial::class, 'contrat_id');
    }
}
