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
            'id' => $this->id ?? '',
            'bith_date' => $this->whelping_date ?? '',
            'observation' => $this->observation ?? '',
            'pairing' => PairingResource::make($this->whenLoaded('pairing')) ?? '',
            'rabbits' => RabbitResource::collection($this->whenLoaded('rabbits')) ?? '',
        ];
    }
}
