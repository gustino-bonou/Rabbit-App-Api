<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Http\Controllers\Controller;
use App\Http\Resources\Whelping\WhelpingCollection;
use App\Models\Whelping;
use App\Responses\Whelping\WhelpingCollectionResponse;
use Illuminate\Http\Request;

class WhelpingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         return new WhelpingCollectionResponse(
            collection: Whelping::with([
                    'pairing',
                ])
                ->paginate(15)
            );
    }
}
