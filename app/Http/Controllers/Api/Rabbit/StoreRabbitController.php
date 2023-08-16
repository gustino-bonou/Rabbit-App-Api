<?php

namespace App\Http\Controllers\Api\Rabbit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Actions\Rabbit\StoreRabbitAction;
use App\Http\DataTransfertObject\Rabbit\RabbitData;
use App\Http\Requests\RabbitRequest;
use App\Models\Whelping;

class StoreRabbitController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RabbitRequest $request)
    {

        if($request->validated('whelping_id') !== null )
        {
            $whelping = Whelping::find($request->validated('whelping_id'));

            $whelping_date = $whelping->whelping_date;
        }
        
        else 
        {
            $whelping_date = $request->validated('whelping_date');
        }

        $dto = new RabbitData(
            name: $request->validated('name'),
            description: $request->validated('description'),
            race: $request->validated('description'),
            image: $request->validated('image'),
            gender: $request->validated('gender'),
            adoption_id: $request->validated('adoption_id'),
            whelping_id: $request->validated('whelping_id'),
            weaning_id: $request->validated('weaning_id'),
            whelping_date: $whelping_date,
            farm_id: $request->user()->farm_id
        );

        $rabbit = (new StoreRabbitAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['rabbit' => $rabbit->toArray()]);

        
    }
}
