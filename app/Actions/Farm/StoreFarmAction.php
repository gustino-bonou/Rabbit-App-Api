<?php

namespace App\Actions\Farm;

use App\Models\Farm;
use Auth;

class StoreFarmAction
{
    public function handle(
        $name,
        $adresse
    ): void {
        $farm = Farm::create([
            'name' => $name,
            'adresse' => $adresse
        ]);

        $farm->user()->associate(Auth::user()->id);
        $farm->save();
    }
}
