<?php

namespace App\Http\DataTransfertObject\Weaning;

class WeaningData
{
    public function __construct(
        private readonly string $observation,
        private readonly string $weaningDate,
        private readonly ?int $adoptionId,
        private readonly int $whelpingId,
        private readonly int $farmId,

    ){}

    public function toArray(): array
    {
        return [
            'weaning_date' => $this->weaningDate,
            'observation' => $this->observation,
            'adoption_id' => $this->adoptionId,
            'whelping_id' => $this->whelpingId,
            'farm_id' => $this->farmId,
        ];
    }
}
