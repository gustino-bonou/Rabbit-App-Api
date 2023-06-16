<?php

namespace App\Http\DataTransfertObject\Farm;

class FarmData
{
    public function __construct(
        private readonly string $name,
        private readonly string $adresse,


    ){}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'adresse' => $this->adresse,

        ];
    }
}
