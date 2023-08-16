<?php

namespace App\Http\Resources\Mortality;

use Illuminate\Http\Request;
use App\Http\Resources\Rabbit\RabbitResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MortalityResource extends JsonResource
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
            'died_date' => $this->died_date ?? null,
            'rabbit' => RabbitResource::make($this->whenLoaded('rabbit')) ?? null,
        ];
    }
}
