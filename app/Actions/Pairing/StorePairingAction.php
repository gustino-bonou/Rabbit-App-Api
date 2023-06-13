<?php

namespace App\Actions\Pairing;

use App\Models\Pairing;
use App\Models\Rabbit;
use Carbon\Carbon;

class StorePairingAction
{
    public function handle(
        $pairing_date,
        $observation,
        $mother_id,
        $father_id,
        $farm_id,
    ): Pairing {
        $pairing = Pairing::create([
            'pairing_date' => Carbon::parse($pairing_date),
            'observation' => $observation,  
        ]);

        $pairing->farm()->associate($farm_id);
        $pairing->mother()->associate($mother_id);
        $pairing->father()->associate($father_id);

        $pairing->save();

        return $pairing;
    }
}
