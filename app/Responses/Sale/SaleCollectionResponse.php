<?php

namespace App\Responses\Sale;

use App\Http\Resources\Sale\SaleCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Support\Responsable;

class SaleCollectionResponse implements Responsable
{

    public function __construct(
        private readonly Collection|LengthAwarePaginator $collection,
        private readonly int $status = 200,
        array $headers = [], int $options = 0
    ){}
    
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: SaleCollection::make(
                $this->collection
            )->response()->getData(),
            status: $this->status,
            headers: ['Content-Type' => 'application/json'],
            options: 0
        );
    }
}
