<?php

namespace App\Http\Controllers\Api\Rabbit;

use App\Http\Controllers\Controller;
use App\Http\Resources\Rabbit\RabbitCollection;
use App\Models\Pairing;
use App\Models\Rabbit;
use App\Models\Whelping;
use App\Responses\Rabbit\RabbitCollectionResponse;
use Illuminate\Http\Request;

class RabbitIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RabbitCollectionResponse
    {
        Whelping::factory()->count(31)->create();
        return new RabbitCollectionResponse(

            collection: Rabbit::with(['weaning', 'whelping', 'adoption'])
                ->paginate(15)
        );

    }
}
