<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeRole extends Model
{
    /** @use HasFactory<\Database\Factories\TypeRoleFactory> */
    use HasFactory;
    protected $fillable = ['nom'];
    protected $table = 'type_roles';
    public function users()
    {
        return $this->hasMany(User::class, 'type_role_id');
    }
    public function getNomAttribute($value)
    {
        return ucfirst($value);
    }
    public function setNomAttribute($value)
    {
        $this->attributes['nom'] = strtolower($value);
    }
}
