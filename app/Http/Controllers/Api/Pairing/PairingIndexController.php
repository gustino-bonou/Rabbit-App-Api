<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Models\Pairing;
use App\Models\Weaning;
use App\Models\Whelping;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Resources\Pairing\PairingCollection;
use App\Responses\Pairing\PairingCollectionResponse;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;

class PairingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetRabbitByCategoryRequest $request)
    {


        $query = Pairing::with([
                'mother.whelping',
                'father.whelping',
            ]);

        
            $minMonth = $request->validated('min_month');
        $maxMonth = $request->validated('max_month');


        // Filtrage des lapins en fonction de minMonth
        if (!is_null($minMonth)) {
            $minDate = Carbon::now()->subMonths($minMonth)->startOfDay();
            $query->where('pairing_date', '<=', $minDate);
        }


        // Filtrage des lapins en fonction de maxMonth
        if (!is_null($maxMonth)) {
            $maxDate = Carbon::now()->subMonths($maxMonth)->endOfDay();
            $query->where('pairing_date', '>=', $maxDate);
        }


        $pairings = $query->paginate(15);

        return new PairingCollectionResponse(
            collection: $pairings
        );
    }
}
