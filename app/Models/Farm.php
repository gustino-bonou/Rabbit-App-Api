<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    use HasFactory;
    public function rabbits(): HasMany
    {
        return $this->hasMany(Rabbit::class);
    }

    public function pairings(): HasMany
    {
        return $this->hasMany(Pairing::class);
    }
    public function weanings(): HasMany
    {
        return $this->hasMany(Weaning::class);
    }
    public function whelpings(): HasMany
    {
        return $this->hasMany(Whelping::class);
    }
    public function adoptions(): HasMany
    {
        return $this->hasMany(Adoption::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
