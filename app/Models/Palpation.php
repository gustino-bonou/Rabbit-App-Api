<?php

namespace App\Models;

use Barryvdh\Reflection\DocBlock\Tag\ReturnTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Palpation extends Model
{
    use HasFactory;

    protected $fillable = [
        'result',
        'palpation_date',
        'pairing_id',
    ];

    public function whelping(): BelongsTo
    {
        return $this->belongsTo(Whelping::class); 
    } 


}
