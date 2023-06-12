<?php

namespace App\Models;

use App\Models\Farm;
use App\Models\Rabbit;
use App\Models\Pairing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Whelping extends Model
{
    use HasFactory;

     protected $fillable = [
        'whelping_date',
        'pairing_id',
        'observation'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function pairing(): BelongsTo
    {
        return $this->belongsTo(Pairing::class);
    }

    public function rabbits(): HasMany
    {
        return $this->hasMany(Rabbit::class);
    }
}
