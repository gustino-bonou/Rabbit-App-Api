<?php

namespace App\Scope;

use App\Models\Rabbit;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class GlobalFarmScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {

        $user = auth()->user();


        if ($user && $user->farm->id) {
            $builder->where('farm_id', $user->farm->id);
        } else {
            return response()->json(['message' => 'Accès refusé ']);
        }
    }
}