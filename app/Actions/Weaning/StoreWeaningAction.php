<?php

namespace App\Actions\Weaning;

use App\Models\Rabbit;
use App\Models\Weaning;

class StoreWeaningAction
{
    public function handle(
        $observation,
        $weaning_date,
        $whelping_id,
        $adoption_id,
        $farm_id,
    ): weaning {
        $weaning = Weaning::create([
            'observation' => $observation,
            'weaning_date' => $weaning_date,
        ]);

        $weaning->farm()->associate($farm_id);
        $weaning->adoption()->associate($adoption_id);
        $weaning->whelping()->associate($whelping_id);

        $weaning->save();

        return $weaning;
    }
}
