<?php

namespace App\Models;

use App\Models\Farm;
use App\Models\Rabbit;
use App\Models\Whelping;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pairing extends Model
{
    use HasFactory;


    protected $fillable = [
        'pairing_date',
        'observation',
        'mother_id',
        'father_id'
    ];

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

    public function verifiedExistence()
    {
    }



}
