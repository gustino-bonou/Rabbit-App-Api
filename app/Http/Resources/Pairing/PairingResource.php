<?php

namespace App\Http\Resources\Pairing;

use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Whelping\WhelpingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PairingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pairing_date' => $this->pairing_date ?? null,
            'observation' => $this->observation ?? null,
            'mother' => RabbitResource::make($this->whenLoaded('mother')) ?? null,
            'father' => RabbitResource::make($this->whenLoaded('father')) ?? null,
            'whelping' => WhelpingResource::make($this->whenLoaded('whelping')) ?? null,
        ];
    }
}
