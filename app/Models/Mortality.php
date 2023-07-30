<?php

namespace App\Models;

use App\Scope\GlobalFarmScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mortality extends Model
{
    use HasFactory;

    protected static function booted()
    {
        parent::booted();

        
        static::addGlobalScope(new GlobalFarmScope());
    }
}
