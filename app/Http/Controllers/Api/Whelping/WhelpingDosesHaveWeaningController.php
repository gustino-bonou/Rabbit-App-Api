<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Models\Whelping;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;
use App\Responses\Whelping\WhelpingCollectionResponse;

class WhelpingDosesHaveWeaningController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetRabbitByCategoryRequest $request)
    {
        
        $query = Whelping::with([
                'pairing',
                'pairing.mother',
                'pairing.father'
            ])
            ->whereDoesntHave('weaning');


        $minMonth = $request->validated('min_month');
        $maxMonth = $request->validated('max_month');


        // Filtrage des lapins en fonction de minMonth
        if (!is_null($minMonth)) {
            $minDate = Carbon::now()->subDays($minMonth);
            $query->where('whelping_date', '<=', $minDate);
        }


        // Filtrage des lapins en fonction de maxMonth
        if (!is_null($maxMonth)) {
            $maxDate = Carbon::now()->subDays($maxMonth)->endOfDay();
            $query->where('whelping_date', '>=', $maxDate);
        }

        $whelpings = $query->paginate(15);

        return new WhelpingCollectionResponse(
            collection: $whelpings
        );
    }
}
