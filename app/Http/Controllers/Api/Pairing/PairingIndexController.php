<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Http\Controllers\Controller;
use App\Http\Resources\Pairing\PairingCollection;
use Illuminate\Http\Request;

class PairingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $weanings = $request->user()->farm->pairings()
            ->with([
                'mother',
                'father',
                'mother.weaning',
                'mother.whelping',
                'mother.adoption',
                'father.adoption',
                'father.whelping',
                'father.weaning'
            ])
            ->paginate(15);

        return new PairingCollection(
            resource: $weanings
            );
    }
}
