<?php

namespace App\Http\Resources\Pairing;

use Illuminate\Http\Request;
use App\Http\Resources\Pairing\PairingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PairingCollection extends ResourceCollection
{

    public $collects = PairingResource::class;
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
