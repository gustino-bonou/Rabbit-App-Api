<?php

namespace App\Http\DataTransfertObject\Farm;

use App\Models\User;

class FarmData
{
    public function __construct(
        private readonly string $name,
        private readonly string $adresse,
        private readonly int $user_id,


    ){}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'adresse' => $this->adresse,
            'user_id' => $this->user_id,
        ];
    }
}
