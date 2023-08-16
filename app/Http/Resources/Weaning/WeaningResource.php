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
            'weaning_date' => $this->weaning_date ?? null,
            'observation' => $this->observation ?? null,
            'deads_kits_number' => $this->deads_kits_number ?? null,
            'kits_number' => $this->kits_number ?? null,
            'whelping' => WhelpingResource::make($this->whenLoaded('whelping')) ?? null,
            'adoption' => AdoptionResource::make($this->whenLoaded('adoption')) ?? null,
            'rabbits' => RabbitResource::collection($this->whenLoaded('rabbits')) ?? null
        ];
    }
}
