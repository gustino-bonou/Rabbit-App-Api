<?php

namespace App\Http\DataTransfertObject\Whelping;

class WhelpingData
{
    public function __construct(
        private readonly string $observation,
        private readonly string $whelpingDate,
        private readonly ?int $pairingId,
        private readonly int $farmId,
        private readonly int $kitsNumber,
        private readonly int $deadsKitsNumber,
    ){}

    public function toArray(): array
    {
        return [
            'whelping_date' => $this->whelpingDate,
            'observation' => $this->observation,
            'pairing_id' => $this->pairingId,
            'farm_id' => $this->farmId,
            'kits_number' => $this->kitsNumber,
            'deads_kits_number' => $this->deadsKitsNumber,
        ];
    }
}
