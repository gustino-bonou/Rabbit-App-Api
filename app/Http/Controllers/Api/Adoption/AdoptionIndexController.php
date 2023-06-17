<?php

namespace App\Http\Controllers\Api\Adoption;

use App\Http\Controllers\Controller;
use App\Http\Resources\Adoption\AdoptionCollection;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return new AdoptionCollection(
            resource: Adoption::with([
                    'rabbits',
                    'adoptiveMother',
                    'whelping',
                    'adoptiveMother.whelping',
                    'adoptiveMother.weaning'
                ])
                ->paginate(15)
            );
    }
}
