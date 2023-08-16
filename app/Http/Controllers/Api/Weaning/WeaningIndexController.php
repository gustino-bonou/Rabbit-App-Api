<?php

namespace App\Http\Controllers\Api\Weaning;

use App\Models\Weaning;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\Weaning\WeaningCollection;
use App\Responses\Weaning\WeaningCollectionResponse;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;

class WeaningIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetRabbitByCategoryRequest $request)
    {
        $query = Weaning::with([
            'whelping',
            'adoption',
        ]);


        $minMonth = $request->validated('min_month');
        $maxMonth = $request->validated('max_month');


        // Filtrage des lapins en fonction de minMonth
        if (!is_null($minMonth)) {
            $minDate = Carbon::now()->subMonths($minMonth);
            $query->where('weaning_date', '<=', $minDate);
        }


        // Filtrage des lapins en fonction de maxMonth
        if (!is_null($maxMonth)) {
            $maxDate = Carbon::now()->subMonths($maxMonth)->endOfDay();
            $query->where('weaning_date', '>=', $maxDate);
        }

        $weanings = $query->paginate(15);


        return new WeaningCollectionResponse(
            collection: $weanings
        );
    }
}
