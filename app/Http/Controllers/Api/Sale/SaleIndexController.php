<?php

namespace App\Http\Controllers\Api\Sale;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;
use App\Responses\Sale\SaleCollectionResponse;

class SaleIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetRabbitByCategoryRequest $request)
    {
        $query = Sale::with([ 
            'rabbit.whelping' 
        ]);


        $minMonth = $request->validated('min_month');
        $maxMonth = $request->validated('max_month');


        // Filtrage des lapins en fonction de minMonth
        if (!is_null($minMonth)) {
            $minDate = Carbon::now()->subMonths($minMonth);
            $query->where('sale_date', '<=', $minDate);
        }


        // Filtrage des lapins en fonction de maxMonth
        if (!is_null($maxMonth)) {
            $maxDate = Carbon::now()->subMonths($maxMonth)->endOfDay();
            $query->where('sale_date', '>=', $maxDate);
        }

        $sales = $query->paginate(15);


        return new SaleCollectionResponse( 
            collection: $sales
        );
    }
}
