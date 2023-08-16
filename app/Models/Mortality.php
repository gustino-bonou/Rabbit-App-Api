<?php

namespace App\Models;

use App\Scope\GlobalFarmScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mortality extends Model
{
    use HasFactory;

    protected $fillable = [
        'died_date',
        'rabbit_id'
    ];
/* 
    protected static function booted()
    {
        parent::booted();
        
        static::addGlobalScope(new GlobalFarmScope());

    } */

    public function rabbit() : BelongsTo
    {
        return $this->belongsTo(Rabbit::class);
    }

     public function farm() : BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }
}
