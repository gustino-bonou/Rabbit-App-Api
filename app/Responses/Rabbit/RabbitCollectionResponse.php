<?php

namespace App\Responses\Rabbit;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Resources\Rabbit\RabbitCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class RabbitCollectionResponse implements Responsable
{
    public function __construct(
        private readonly Collection|LengthAwarePaginator $collection,
        private readonly int $status = 200,
    ){}
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: RabbitCollection::make(
                $this->collection
            )->response()->getData(),
            status: $this->status
        );
    }
}
