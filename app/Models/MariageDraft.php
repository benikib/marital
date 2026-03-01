<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MariageDraft extends Model
{
    use HasFactory;

    protected $table = 'mariage_drafts';

    protected $fillable = [
        'user_id', 'data', 'files'
    ];

    protected $casts = [
        'data' => 'array',
        'files' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
