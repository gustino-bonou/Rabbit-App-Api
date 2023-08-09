<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Http\Controllers\Controller;
use App\Models\Whelping;
use App\Responses\Whelping\WhelpingCollectionResponse;
use Illuminate\Http\Request;

class WhelpingDosesHaveWeaningController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $whelpings = Whelping::with([
                'pairing',
                'pairing.mother',
                'pairing.father'
            ])
            ->whereDoesntHave('weaning')
            ->paginate(15);

        return new WhelpingCollectionResponse(
            collection: $whelpings
        );
    }
}
