<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Actions\Pairing\StorePairingAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransfertObject\Pairing\PairingData;
use App\Http\Requests\PairingRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class StorePairingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PairingRequest $request)
    {
        $dto = new PairingData(
            pairingDate: $request->validated('pairing_date'),
            observation: $request->validated('observation'),
            fatherId: $request->validated('father_id'),
            motherId: $request->validated('mother_id'),
            farmID: $request->user()->farm_id
        );

       $pairing =  (new StorePairingAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['pairing' => $pairing->toArray()], 200);
    }
}
