<?php

namespace App\Models;

use App\Models\Farm;
use App\Models\Rabbit;
use App\Models\Whelping;
use App\Scope\GlobalFarmScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Weaning extends Model
{
    use HasFactory;

    protected $fillable = [
        'whelping_id',
        'observation',
        'weaning_date',
        'adoption_id'
    ];

        public function getWeaningDateAttribute($value)
    {
        return  \Carbon\Carbon::parse($value)->toDateTimeString();
    }

    public function getCreatedAtAttribute($value)
    {
        return  \Carbon\Carbon::parse($value)->toDateTimeString();
    }



    protected static function booted()
    {
        parent::booted();

        
        static::addGlobalScope(new GlobalFarmScope());
    }


    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
    public function whelping(): BelongsTo
    {
        return $this->belongsTo(Whelping::class);
    }
    public function adoption(): BelongsTo
    {
        return $this->belongsTo(Adoption::class);
    }



    public function rabbits(): HasMany
    {
        return $this->hasMany(Rabbit::class);
    }
}
