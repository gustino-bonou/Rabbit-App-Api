<?php

namespace App\Http\Resources\Rabbit;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RabbitCollection extends ResourceCollection
{
    public $collects = RabbitResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection
        ];
    }
}
