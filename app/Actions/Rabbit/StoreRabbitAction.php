<?php

namespace App\Actions\Rabbit;

use App\Models\Rabbit;

class StoreRabbitAction
{
    public function handle(
        $name,
        $description,
        $race,
        $image,
        $gender,
        $whelping_date,
        $whelping_id,
        $adoption_id,
        $weaning_id,
        $farm_id,
    ): Rabbit {
        $rabbit = Rabbit::create([ 
            'name' => $name,
            'description' => $description,
            'race' => $race,
            'image' => $image,
            'gender' => $gender,  
            'whelping_date' => $whelping_date,  
        ]);

        $rabbit->weaning()->associate($weaning_id);
        $rabbit->adoption()->associate($adoption_id);
        $rabbit->whelping()->associate($whelping_id);
        $rabbit->farm()->associate($farm_id);

        $rabbit->save();

        return $rabbit;
    }
}
