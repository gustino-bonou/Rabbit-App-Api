<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Models\Pairing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Responses\Pairing\PairingCollectionResponse;

class PairingHavenotWhelpingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pairings = Pairing::with([
                'mother',
                'father',
            ])
            ->whereDoesntHave('whelping')
            ->paginate(15);

        return new PairingCollectionResponse(
            collection: $pairings
        );
    }
}
