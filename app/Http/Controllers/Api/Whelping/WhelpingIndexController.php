<?php

namespace App\Http\Controllers\Api\Whelping;

use App\Http\Controllers\Controller;
use App\Http\Resources\Whelping\WhelpingCollection;
use Illuminate\Http\Request;

class WhelpingIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         return new WhelpingCollection(
            resource: $request->user()->farm->whelpings()
                ->with([
                    'pairing',
                    'rabbits',
                ])
                ->paginate(10)->load('rabbits.adoption', 'rabbits.weaning')
            );
    }
}
