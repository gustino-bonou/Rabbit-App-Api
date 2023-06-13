<?php

namespace App\Actions\Adoption;

use App\Models\Adoption;
use App\Models\Pairing;
use App\Models\Rabbit;
use Carbon\Carbon;

class StoreAdoptionAction
{
    public function handle(
        $adoption_date,
        $observation,
        $adoption_mother,
        $whelping_id,
        $farm_id,
    ): Adoption {
        $adoption = Adoption::create([
            'adoption_date' => Carbon::parse($adoption_date),
            'observation' => $observation,  
        ]);

        $adoption->farm()->associate($farm_id);
        $adoption->adoptiveMother()->associate($adoption_mother);
        $adoption->whelping()->associate($whelping_id);

        $adoption->save();

        return $adoption;
    }
}
