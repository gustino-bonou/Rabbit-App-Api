<?php

namespace App\Http\DataTransfertObject\Rabbit;

class RabbitData
{
    public function __construct(
        private readonly string $name,
        private readonly string $description,
        private readonly string $race,
        private readonly string $image,
        private readonly string $gender,
        private readonly string $whelping_date,
        private readonly string $whelping_id,
        private readonly string $adoption_id,
        private readonly string $weaning_id,
        private readonly string $farm_id,
    ){}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'race' => $this->race,
            'image' => $this->image,
            'gender' => $this->gender,
            'whelping_date' => $this->whelping_date,
            'adoption_id' => $this->adoption_id,
            'whelping_id' => $this->whelping_id,
            'weaning_id' =>  $this->weaning_id,
            'farm_id' => $this->farm_id
        ];
    }
}
