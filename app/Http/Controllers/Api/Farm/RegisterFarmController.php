<?php

namespace App\Http\Controllers\Api\Farm;

use App\Actions\Farm\StoreFarmAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransfertObject\Farm\FarmData;
use App\Http\Requests\Farm\FarmRequest;
use Illuminate\Http\Request;

class RegisterFarmController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FarmRequest $request)
    {
        $dto = new FarmData(
            name: $request->validated('name'),
            adresse: $request->validated('adresse')
        );

        (new StoreFarmAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['message' => 'Farm Create successfully']);
    }
}
