<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Models\Pairing;
use App\Models\Whelping;
use App\Responses\Pairing\PairingCollectionResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class NearbyWhelpingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $startDate = Carbon::now()->subDays(35)->toDateString();
        $endDate = Carbon::now()->subDays(24)->toDateString();

        $pairings = Pairing::with('father', 'mother')
            ->whereBetween('pairing_date', [$startDate, $endDate])
            ->whereDoesntHave('whelping')
            ->get();

        return new PairingCollectionResponse(
            collection: $pairings
        );
    }
}
