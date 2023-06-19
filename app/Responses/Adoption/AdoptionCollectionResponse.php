<?php

namespace App\Responses\Adoption;

use App\Http\Resources\Adoption\AdoptionCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Resources\Rabbit\RabbitCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Parent_;

class AdoptionCollectionResponse implements Responsable
{
    public function __construct(
        private readonly Collection|LengthAwarePaginator $collection,
        private readonly int $status = 200,
        array $headers = [], int $options = 0
    ){}
    
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: AdoptionCollection::make(
                $this->collection
            )->response()->getData(),
            status: $this->status,
            headers: ['Content-type' => 'application/json'],
            options: 0
        );
    }
}
