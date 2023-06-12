<?php

namespace App\Actions\Farm;

use App\Models\Farm;
use Auth;

class StoreFarmAction
{
    public function handle(
        $name
    ): void {
        $farm = Farm::create([
            'name' => $name,
        ]);

        $farm->user()->associate(Auth::user()->id);
        $farm->save();
    }
}
