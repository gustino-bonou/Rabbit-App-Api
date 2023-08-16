<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Models\Whelping;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Responses\Whelping\WhelpingCollectionResponse;

class WhelpingInMonthIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $maxDate = Carbon::now()->subDays(30)->endOfDay();

        $whelpings = Whelping::with('pairing.mother', 'pairing.father', 'rabbits')
            ->where('whelping_date', '>=', $maxDate)
            ->orderBy('whelping_date', 'desc')
            ->get();


        return new WhelpingCollectionResponse(
            collection: $whelpings
        );
    }
}
