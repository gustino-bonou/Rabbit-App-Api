<?php

namespace App\Http\Controllers\Api\Whelping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Whelping\WhelpingResource;
use App\Models\Whelping;

class WhelpingController extends Controller
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
        $rabbit = Whelping::find($id);

        if($rabbit !== null)
        {
            $rabbit->load(
                'rabbits',
                'pairing.mother.whelping',
                'pairing.father.whelping',
            );

            return new WhelpingResource(resource: $rabbit);
        }
        else
        {
            return response()->json(['message' => 'any response to your query'], status: 422);
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
