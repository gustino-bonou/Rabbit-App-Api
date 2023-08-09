<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Models\Pairing;
use App\Models\Whelping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pairing\PairingCollection;
use App\Models\Weaning;
use App\Responses\Pairing\PairingCollectionResponse;

class PairingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {


        $pairings = Pairing::with([
                'mother',
                'father',
                'mother.weaning',
                'mother.whelping',
                'mother.adoption',
                'father.adoption',
                'father.whelping',
                'father.weaning'
            ])->get();

        return new PairingCollectionResponse(
            collection: $pairings
        );
    }
}
