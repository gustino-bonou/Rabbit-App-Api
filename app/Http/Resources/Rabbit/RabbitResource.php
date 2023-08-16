<?php

namespace App\Http\Resources\Rabbit;

use Illuminate\Http\Request;
use App\Http\Resources\Weaning\WeaningResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Adoption\AdoptionResource;
use App\Http\Resources\Whelping\WhelpingResource;

class RabbitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            "id" => $this->id,
            "name" => $this->name ?? null,

            "description" => $this->description ?? null,
            "race" => $this->race ?? null,
            "gender" => $this->gender ?? null,
            "image" => $this->image ?? null,
            "created_at" => $this->created_at ?? null,
            "whelping_date" => $this->whelping_date ?? null,
            
            'weaning' => WeaningResource::make($this->whenLoaded('weaning')) ?? null ,
            'whelping' => WhelpingResource::make($this->whenLoaded('whelping')) ?? null,
            'adoption' => AdoptionResource::make($this->whenLoaded('adoption')) ?? null 
        ];
    }
}
