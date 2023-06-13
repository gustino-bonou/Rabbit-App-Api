<?php

namespace App\Models;

use App\Models\Farm;
use App\Models\Rabbit;
use App\Models\Pairing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Client\HttpClientException;

class Whelping extends Model
{
    use HasFactory;

     protected $fillable = [
        'whelping_date',
        'pairing_id',
        'observation'
    ];

    protected static function boot()
    {
        parent::boot();

        /* static::creating(function ($whelping) {
            $pairing = Pairing::find($whelping->pairing_id);

            dd($whelping->pairing_id);
            if ($pairing && $pairing->whelpings()->exists()) {
                throw new \Exception("Ce pairing est déjà pris par un autre whelping.");
            }
        }); */
    }

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

    public function weaning(): HasOne
    {
        return $this->hasOne(Weaning::class);
    }
}
