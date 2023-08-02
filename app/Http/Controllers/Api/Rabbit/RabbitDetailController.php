<?php

namespace App\Http\Controllers\Api\Rabbit;

use App\Models\Rabbit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RabbitDetailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {

        $rabbit = Rabbit::find($id)->load('weaning', 
                'adoption',
                'whelping',
                'whelping.pairing',
                'whelping.pairing.father', 
                'whelping.pairing.mother',
                'whelping.pairing.mother.whelping',
                'whelping.pairing.mother.whelping');

        if($rabbit !== null )
        {
            return response()->json(['data' => $rabbit]);
        }

        else 
        {
            return response()->json(['data' => "no content"], status:404);
        }

    }
    
}
