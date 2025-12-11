<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class commune extends Model
{
    /** @use HasFactory<\Database\Factories\CommuneFactory> */
    use HasFactory;
    protected $fillable = ['nom', 'province_id'];
    protected $table = 'communes';
    public function province()
    {
        return $this->belongsTo(province::class, 'province_id');
    }
    public function users()
    {
        return $this->hasMany(User::class, 'commune_id');
    }
    public function mariages()
    {
        return $this->hasMany(mariage::class, 'commune_id');
    }

}
