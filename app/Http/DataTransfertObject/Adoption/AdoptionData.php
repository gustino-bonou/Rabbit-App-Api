<?php

namespace App\Http\DataTransfertObject\Adoption;

class AdoptionData
{
    public function __construct(
        private readonly string $adoptionDate,
        private readonly string $observation,
        private readonly int $motherId,
        private readonly int $whelpingId,
        private readonly int $farmId,

    ){}

    public function toArray(): array
    {
        return [
            'adoption_date' => $this->adoptionDate,
            'observation' => $this->observation,
            'adoption_mother' => $this->motherId,
            'whelping_id' => $this->whelpingId,
            'farm_id' => $this->farmId,
        ];
    }
}
