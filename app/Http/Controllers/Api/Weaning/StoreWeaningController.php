<?php

namespace App\Http\Controllers\Api\Weaning;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeaningRequest;
use App\Actions\Weaning\StoreWeaningAction;
use App\Http\DataTransfertObject\Weaning\WeaningData;
use App\Models\Weaning;

class StoreWeaningController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(WeaningRequest $request)
    {
        $dto = new WeaningData(
            weaningDate: $request->validated('weaning_date'),
            observation: $request->validated('observation'),
            adoptionId: $request->validated('adoption_id'),
            whelpingId: $request->validated('whelping_id'),
            farmId: $request->user()->farm_id,
        );

        $weaning = (new StoreWeaningAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['weaning' => Weaning::with('adoption', 'whelping')->find($weaning->id)->toArray()], 200);
    }
}
