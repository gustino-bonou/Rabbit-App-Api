<?php

namespace App\Models;

use App\Models\Farm;
use App\Models\Rabbit;
use App\Models\Whelping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'adoption_date',
        'whelping_id',
        'observation',
        'adoption_mother',
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function rabbits(): HasMany
    {
        return $this->hasMany(Rabbit::class);
    }

    public function whelping(): BelongsTo
    {
        return $this->belongsTo(Whelping::class);
    }
    
    public function adoptiveMother(): BelongsTo
    {
        return $this->belongsTo(Rabbit::class, 'adoption_mother');
    }

}
