<?php

namespace App\Http\Controllers\Api\Mortality;

use App\Responses\Mortality\MortalityCollectionResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;
use App\Models\Mortality;

class MortalityIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetRabbitByCategoryRequest $request)
    {
        $query = Mortality::with([
            'rabbit.whelping' 
        ]);


        $minMonth = $request->validated('min_month');
        $maxMonth = $request->validated('max_month');


        // Filtrage des lapins en fonction de minMonth
        if (!is_null($minMonth)) {
            $minDate = Carbon::now()->subMonths($minMonth);
            $query->where('died_date', '<=', $minDate);
        }


        // Filtrage des lapins en fonction de maxMonth
        if (!is_null($maxMonth)) {
            $maxDate = Carbon::now()->subMonths($maxMonth)->endOfDay();
            $query->where('died_date', '>=', $maxDate);
        }

        $mortalities = $query->paginate(15);


        return new MortalityCollectionResponse(
            collection:$mortalities
        );
    }
}
