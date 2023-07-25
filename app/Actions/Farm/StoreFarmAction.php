<?php

namespace App\Actions\Farm;

use App\Models\Farm;
use App\Models\User;
use Auth;

class StoreFarmAction
{
    public function handle(
        $name,
        $adresse,
        $user_id ,
    ): Farm {
        $farm = Farm::create([
            'name' => $name,
            'adresse' => $adresse,
        ]);

        $farm->save();

        $user = User::find($user_id);

        $user->farm_id = $farm->id;

        $user->save();

        return $farm;
    }
}
