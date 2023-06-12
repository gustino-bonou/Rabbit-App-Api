<?php

namespace App\Http\Controllers\Api\Rabbit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rabbit\RabbitCollection;

use App\Responses\Rabbit\RabbitCollectionResponse;
use Illuminate\Http\Request;

class RabbitIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RabbitCollectionResponse
    {

        return new RabbitCollectionResponse(
            collection: $request->user()->farms()->first()
                ->rabbits()
                ->with(['weaning', 'whelping', 'adoption'])
                ->paginate(10)
        );

    }
}
