<?php

namespace App\Models;

use App\Models\Farm;
use App\Models\Rabbit;
use App\Models\Whelping;
use App\Scope\GlobalFarmScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pairing extends Model
{
    use HasFactory;


    protected $fillable = [
        'pairing_date',
        'observation',
        'mother_id',
        'father_id'
    ];


    protected static function booted()
    {
        parent::booted();

        
        static::addGlobalScope(new GlobalFarmScope());
    }

        public function getPairingDateAttribute($value)
    {
        return  \Carbon\Carbon::parse($value)->toDateTimeString();
    }

    public function getCreatedAtAttribute($value)
    {
        return  \Carbon\Carbon::parse($value)->toDateTimeString();
    }


    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Rabbit::class, 'mother_id');
    }
    public function father(): BelongsTo
    {
        return $this->belongsTo(Rabbit::class, 'father_id');
    }

    public function whelping(): HasOne
    {
        return $this->hasOne(Whelping::class);
    }

    public function palpations(): HasMany
    {
        return $this->hasMany(Palpation::class);
    }


    public function verifiedExistence()
    {
    }



}
