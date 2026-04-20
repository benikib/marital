<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MariageParent extends Model
{
    use HasFactory;

    protected $table = 'mariage_parents';

    public $timestamps = false;

    protected $fillable = [
        'mariage_id',
        'personne_id',
        'type_parent',
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
