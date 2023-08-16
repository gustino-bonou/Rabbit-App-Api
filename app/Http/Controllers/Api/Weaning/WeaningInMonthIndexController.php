<?php

namespace App\Http\Controllers\Api\Weaning;

use App\Models\Weaning;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Responses\Weaning\WeaningCollectionResponse;

class WeaningInMonthIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $maxDate = Carbon::now()->subDays(30)->endOfDay();

        $weanings = Weaning::with('whelping')
            ->where('weaning_date', '>=', $maxDate)
            ->orderBy('weaning_date', 'desc')
            ->get();


        return new WeaningCollectionResponse(
            collection: $weanings
        );
    }
}
