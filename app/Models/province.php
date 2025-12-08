<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    /** @use HasFactory<\Database\Factories\ProvinceFactory> */
    use HasFactory;
    protected $fillable = ['nom'];
    protected $table = 'provinces';
    public function communes()
    {
        return $this->hasMany(Commune::class, 'province_id');
    }

}
