<?php

namespace App\Http\Controllers\Api\Weaning;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Weaning\WeaningResource;
use App\Models\Weaning;

class WeaningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $weaning = Weaning::find($id);
        if($weaning !== null)
        {
            $weaning->load(
                'rabbits',
                'adoption',
                'whelping',
                'rabbits.adoption',
                'whelping.rabbits'
            );

            return new WeaningResource($weaning);
        }
        else 
        {
            return response()->json(['data' => null, 'message' => 'any response to your query']);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
