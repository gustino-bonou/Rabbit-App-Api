<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Actions\Weaning\StoreWeaningAction;
use App\Actions\Whelping\StoreWhelpingAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransfertObject\Whelping\WhelpingData;
use App\Http\Requests\WhelpingRequest;
use App\Models\Whelping;
use Illuminate\Http\Request;

class StoreWhelpingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(WhelpingRequest $request)
    {
        $deadNumber = $request->validated('deads_kits_number');

        if($deadNumber === null )
        {
            $deadNumber = 0;
        }

        $dto = new WhelpingData(
            observation: $request->validated('observation'),
            whelpingDate: $request->validated('whelping_date'),
            pairingId: $request->validated('pairing_id'),
            farmId: $request->user()->farm_id,
            deadsKitsNumber:  $deadNumber,
            kitsNumber:  $request->validated('kits_number'),
        );

        $whelping = (new StoreWhelpingAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['whelping' => Whelping::with('pairing')->find($whelping->id)->toArray()], 200);
    }
}
