<?php

namespace App\Http\Controllers\Api\Rabbit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Rabbit\StoreRabbitAction;
use App\Http\DataTransfertObject\Rabbit\RabbitData;
use App\Http\Requests\RabbitRequest;

class StoreRabbitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RabbitRequest $request)
    {
       return response()->json(['message' => 'rabbit saved']);

        $dto = new RabbitData(
            name: $request->validated('name'),
            description: $request->validated('description'),
            race: $request->validated('description'),
            image: $request->validated('image'),
            gender: $request->validated('gender'),
            adoption_id: $request->validated('adoption_id'),
            whelping_id: $request->validated('whelping_id'),
            weaning_id: $request->validated('weaning_id'),
            whelping_date: $request->validated('whelping_date'),
            farm_id: $request->user()->farm->id
        );

        (new StoreRabbitAction)->handle(
            ...$dto->toArray()
        );

        
    }
}
