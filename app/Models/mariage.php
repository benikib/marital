<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mariage extends Model
{
    /** @use HasFactory<\Database\Factories\MariageFactory> */
    use HasFactory;

    protected $fillable = [
        'lieu_mariage',
        'date_mariage',
        'status_id',
        'regime_matrimonial_id',
        'ayant_droit_coutinier_id',
        'epouse_id',
        'epoux_id',
        'user_id',
        'commune_id'
    ];

    protected $casts = [
        'date_mariage' => 'date'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function regimeMatrimonial()
    {
        return $this->belongsTo(RegimeMatrimoniale::class, 'regime_matrimonial_id');
    }

    public function ayantDroitCoutinier()
    {
        return $this->belongsTo(AyantDroitCoutinier::class);
    }

    public function epouse()
    {
        return $this->belongsTo(Epouse::class);
    }

    public function epoux()
    {
        return $this->belongsTo(Epoux::class, 'epoux_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function parentsEpouse()
    {
        return $this->hasMany(parentEpouse::class, 'epouse_id');
    }
    public function statusMariage()
    {
        return $this->belongsTo(Status::class, 'status_id');

    }
  public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

}
