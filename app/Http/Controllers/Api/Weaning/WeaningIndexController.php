<?php

namespace App\Http\Controllers\Api\Weaning;

use App\Http\Controllers\Controller;
use App\Http\Resources\Weaning\WeaningCollection;
use Illuminate\Http\Request;

class WeaningIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new WeaningCollection(
            resource: $request->user()->farm->weanings()
                ->with([
                    'whelping',
                    'rabbits',
                    'adoption',
                ])
                ->paginate(10)
                ->load('rabbits.adoption', 'rabbits.whelping')
            );
    }
}
