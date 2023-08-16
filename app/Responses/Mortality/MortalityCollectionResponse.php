<?php

namespace App\Responses\Mortality;

use App\Http\Resources\Mortality\MortalityCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Resources\Rabbit\RabbitCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class MortalityCollectionResponse implements Responsable
{
    public function __construct(
        private readonly Collection|LengthAwarePaginator $collection,
        private readonly int $status = 200,
        array $headers = [], int $options = 0
    ){}
    
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: MortalityCollection::make( 
                $this->collection
            )->response()->getData(),
            status: $this->status,
            headers: ['Content-Type' => 'application/json'],
            options: 0
        );
    }
}
