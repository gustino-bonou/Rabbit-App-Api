<?php

namespace App\Http\Resources\Adoption;

use Illuminate\Http\Request;
use App\Http\Resources\Adoption\AdoptionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdoptionCollection extends ResourceCollection
{
    public $collects = AdoptionResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection
        ];;
    }
}
