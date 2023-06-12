<?php

namespace App\Http\Controllers\Api\Adoption;

use App\Http\Controllers\Controller;
use App\Http\Resources\Adoption\AdoptionCollection;
use Illuminate\Http\Request;

class AdoptionIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new AdoptionCollection(
            resource: $request->user()->farms()->first()->adoptions()
                ->with([
                    'rabbits',
                    'adoptiveMother',
                    'whelping',
                ])
                ->paginate(1)
                ->load('adoptiveMother.whelping', 'adoptiveMother.weaning')
            );
    }
}
