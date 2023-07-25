<?php

namespace App\Http\Resources\Pairing;

use App\Http\Resources\Rabbit\RabbitResource;
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
            'id' => $this->id ?? '',
            'pairing_date' => $this->pairing_date ?? '',
            'observation' => $this->observation ?? '',
            'mother' => RabbitResource::make($this->whenLoaded('mother')) ?? '',
            'father' => RabbitResource::make($this->whenLoaded('father')) ?? '',
        ];
    }
}
