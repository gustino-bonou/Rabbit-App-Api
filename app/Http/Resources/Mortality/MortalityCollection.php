<?php

namespace App\Http\Resources\Mortality;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MortalityCollection extends ResourceCollection
{

    public $collects = MortalityResource::class;
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
