<?php

namespace App\Responses\Whelping;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Resources\Rabbit\RabbitCollection;
use App\Http\Resources\Weaning\WeaningCollection;
use App\Http\Resources\Whelping\WhelpingCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use phpDocumentor\Reflection\Types\Parent_;

class WhelpingCollectionResponse implements Responsable
{
    public function __construct(
        private readonly Collection|LengthAwarePaginator $collection,
        private readonly int $status = 200,
        private array $headers = ['Content-type' => 'application/json'], int $options = 0
    ){}
    
    public function toResponse($request): JsonResponse
    {
        return response()->json(
            data: WhelpingCollection::make(
                $this->collection
            )->response()->getData(),
            status: $this->status,
            headers: $this->headers,
            options: 0
        );
    }
}
