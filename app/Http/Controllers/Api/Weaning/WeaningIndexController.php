<?php

namespace App\Http\Controllers\Api\Weaning;

use App\Http\Controllers\Controller;
use App\Http\Resources\Weaning\WeaningCollection;
use App\Models\Weaning;
use App\Responses\Weaning\WeaningCollectionResponse;
use Illuminate\Http\Request;

class WeaningIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new WeaningCollectionResponse(
            collection: Weaning::with([
                    'whelping',
                    'adoption',
                ])
                ->paginate(15)
            );
    }
}
