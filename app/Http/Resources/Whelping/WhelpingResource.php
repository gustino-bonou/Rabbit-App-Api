<?php

namespace App\Http\Resources\Whelping;

use App\Http\Resources\Pairing\PairingResource;
use App\Http\Resources\Rabbit\RabbitResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhelpingResource extends JsonResource
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
            'whelping_date' => $this->whelping_date ?? null,
            'created_at' => $this->created_at ?? null,
            'observation' => $this->observation ?? null,
            'race' => $this->race !== null ?? null,
            'deads_kits_number' => $this->deads_kits_number ?? null,
            'kits_number' => $this->kits_number ?? null,
            'pairing' => PairingResource::make($this->whenLoaded('pairing')) ?? null,
            'rabbits' => RabbitResource::collection($this->whenLoaded('rabbits')) ?? null,
        ];
    }
}
