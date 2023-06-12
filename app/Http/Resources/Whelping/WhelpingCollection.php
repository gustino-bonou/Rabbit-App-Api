<?php

namespace App\Http\Resources\Whelping;

use Illuminate\Http\Request;
use App\Http\Resources\Whelping\WhelpingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WhelpingCollection extends ResourceCollection
{
    public $collects = WhelpingResource::class;
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
