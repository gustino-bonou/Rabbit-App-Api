<?php

namespace App\Http\Resources\Sale;

use Illuminate\Http\Request;
use App\Http\Resources\Rabbit\RabbitResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'sale_date' => $this->died_date ?? null,
            'rabbit' => RabbitResource::make($this->whenLoaded('rabbit')) ?? null,
        ];
    }
}
