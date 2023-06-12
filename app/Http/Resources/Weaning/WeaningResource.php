<?php

namespace App\Http\Resources\Weaning;

use App\Http\Resources\Adoption\AdoptionResource;
use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Whelping\WhelpingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeaningResource extends JsonResource
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
            'weaning_date' => $this->weaning_date,
            'observation' => $this->observation,
            'whelping' => WhelpingResource::make($this->whenLoaded('whelping')),
            'adoption' => AdoptionResource::make($this->whenLoaded('adoption')),
            'rabbits' => RabbitResource::collection($this->whenLoaded('rabbits'))
        ];
    }
}
