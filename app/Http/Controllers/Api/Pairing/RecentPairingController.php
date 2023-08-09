<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Models\Pairing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pairing\PairingResource;
use App\Responses\Pairing\PairingCollectionResponse;

class RecentPairingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $dateLimite = Carbon::now()->subDays(45); 

        
        $pairings = Pairing::with('mother', 'father')->whereDate('pairing_date', '>=', $dateLimite)->get();

        return new PairingCollectionResponse(
            collection: $pairings
        );

    }
}
