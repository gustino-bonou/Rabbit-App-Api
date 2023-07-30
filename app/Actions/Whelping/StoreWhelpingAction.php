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
        $kits_number,
        $deads_kits_number
    ): Whelping {

        #dd($kits_number, $deads_kits_number);
        $whelping = Whelping::create([
            'observation' => $observation,
            'whelping_date' => $whelping_date,
            'kits_number' => (int) $kits_number,
            'deads_kits_number' =>(int) $deads_kits_number,
        ]);

        $whelping->kits_number = (int) $kits_number;
        $whelping->deads_kits_number = (int) $deads_kits_number;

        $whelping->pairing()->associate($pairing_id);

        $whelping->farm()->associate($farm_id);

        $whelping->save();

        return $whelping;
    }
}
