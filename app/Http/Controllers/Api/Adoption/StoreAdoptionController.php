<?php

namespace App\Http\Controllers\Api\Adoption;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdoptionRequest;
use App\Actions\Adoption\StoreAdoptionAction;
use App\Http\DataTransfertObject\Adoption\AdoptionData;

class StoreAdoptionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdoptionRequest $request)
    {
        $dto = new AdoptionData(
            adoptionDate: $request->validated('adoption_date'),
            observation: $request->validated('observation'),
            motherId: $request->validated('adoption_mother'),
            whelpingId: $request->validated('whelping_id'),
            farmId: $request->user()->farm->id,
        );

       $adoption =  (new StoreAdoptionAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['data' => $adoption->toArray()], 200);
    }
}
