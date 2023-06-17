<?php

namespace App\Actions\Whelping;

use App\Models\Weaning;
use App\Models\Whelping;

class StoreWhelpingAction
{
    public function handle(
        $observation,
        $whelping_date,
        $pairing_id,
        $farm_id,
    ): Whelping {
        $whelping = Whelping::create([
            'observation' => $observation,
            'whelping_date' => $whelping_date,
        ]);

        $whelping->pairing()->associate($pairing_id);

        $whelping->save();

        return $whelping;
    }
}
