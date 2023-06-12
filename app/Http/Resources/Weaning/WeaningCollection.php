<?php

namespace App\Http\Resources\Weaning;

use Illuminate\Http\Request;
use App\Http\Resources\Weaning\WeaningResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WeaningCollection extends ResourceCollection
{
    public $collects = WeaningResource::class;
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
