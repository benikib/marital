<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divorce extends Model
{
    use HasFactory;

    protected $table = 'divorces';

    protected $fillable = [
        'user_id',
        'entite_id',
        'mariage_id',
        'date_divorce',
        'divorce_rendu',
        'date_transcription',
        'date_jugement',
        'numero_jugement',
        'mentions_complementaire',
        'documents',
        'soussignataire',
        'num_acte',
    ];

    protected $casts = [
        'date_divorce' => 'date',
        'date_transcription' => 'date',
        'date_jugement' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function entite()
    {
        return $this->belongsTo(EntiteAdministrative::class, 'entite_id');
    }

    public function mariage()
    {
        return $this->belongsTo(Mariage::class, 'mariage_id');
    }
}
