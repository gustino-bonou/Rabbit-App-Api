<?php

namespace App\Http\Resources\Adoption;

use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Whelping\WhelpingResource;
use App\Models\Whelping;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdoptionResource extends JsonResource
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
            'adoption_date' => $this->adoption_date,
            'observation' => $this->observation,
            'mother' => RabbitResource::make($this->whenLoaded('adoptiveMother')),
            'whelping' => WhelpingResource::make($this->whenLoaded('whelping')),
            'rabbits' => RabbitResource::collection($this->whenLoaded('rabbits'))
        ];
    }
}
