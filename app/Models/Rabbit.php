<?php

namespace App\Models;

use App\Models\Pairing;
use App\Models\Weaning;
use App\Models\Adoption;
use App\Models\Whelping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;

class Rabbit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'race',
        'image',
        'gender',
        'whelping_date',
        'adoption_id',
        'whelping_id',
        'weaning_id'
    ];

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function motherInPairing(): HasMany
    {
        return $this->hasMany(Pairing::class, 'mother_id', );
    }
    public function fatherInPairing(): HasMany
    {
        return $this->hasMany(Pairing::class, 'father_id', );
    }

    public function weaning(): BelongsTo
    {
        return $this->belongsTo(Weaning::class);
    }

    public function adoption(): BelongsTo
    {
        return $this->belongsTo(Adoption::class);
    }

    public function whelping(): BelongsTo
    {
        return $this->belongsTo(Whelping::class);
    }

    public function getSlug(): string 
    {
        return Str::slug($this->description);
    }

}
