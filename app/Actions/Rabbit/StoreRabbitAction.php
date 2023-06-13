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
        $weaning_id
        
    ): void {
        Rabbit::create([
            'name' => $name,
            'description' => $description,
            'race' => $race,
            'image' => $image,
            'gender' => $gender,  
            'whelping_date' => $whelping_date,  
            'whelping_id' => $whelping_id,  
            'adoption_id' => $adoption_id,  
            'weaning_id' => $weaning_id,  
        ]);
    }
}
