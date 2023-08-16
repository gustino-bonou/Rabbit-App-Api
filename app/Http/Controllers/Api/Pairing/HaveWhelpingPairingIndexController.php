<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Models\Pairing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;
use App\Responses\Pairing\PairingCollectionResponse;

class HaveWhelpingPairingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(GetRabbitByCategoryRequest $request)
    {
        $query = Pairing::with([
                'mother.whelping', 
                'father.whelping',
                'whelping'
            ])
            ->whereHas('whelping');

        
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
