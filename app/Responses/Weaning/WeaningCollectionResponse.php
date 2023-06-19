<?php

namespace App\Responses\Weaning;

use App\Http\Resources\Pairing\PairingCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Resources\Rabbit\RabbitCollection;
use App\Http\Resources\Weaning\WeaningCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Parent_;

class WeaningCollectionResponse implements Responsable
{
    public function __construct(
        private readonly Collection|LengthAwarePaginator $collection,
        private readonly int $status = 200,
        array $headers = [], int $options = 0
    ){}
    
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: WeaningCollection::make(
                $this->collection
            )->response()->getData(),
            status: $this->status,
            headers: ['Content-type' => 'application/json'],
            options: 0
        );
    }
}
