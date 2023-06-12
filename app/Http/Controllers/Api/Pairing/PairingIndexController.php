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

        return new PairingCollection(
            resource: $request->user()->farms()->first()->pairings()
                ->with([
                    'mother',
                    'father',
                ])
                ->paginate(10)
                ->load('mother.weaning', 'mother.whelping', 'mother.adoption', 'father.adoption', 'father.whelping', 'father.weaning')
            );
    }
}
