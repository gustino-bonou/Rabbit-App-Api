<?php

namespace App\Http\DataTransfertObject\Pairing;

class PairingData
{
    public function __construct(
        private readonly string $pairingDate,
        private readonly string $observation,
        private readonly int $fatherId,
        private readonly int $motherId,
        private readonly int $farmID,

    ){}

    public function toArray(): array
    {
        return [
            'pairing_date' => $this->pairingDate,
            'observation' => $this->observation,
            'father_id' => $this->fatherId,
            'mother_id' => $this->motherId,
            'farm_id' => $this->farmID,
        ];
    }
}
