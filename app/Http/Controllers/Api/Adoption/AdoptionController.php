<?php

namespace App\Http\Controllers\Api\Adoption;

use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Adoption\AdoptionResource;

class AdoptionController extends Controller
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
    public function show(string $id, Request $request)
    {
        $adoption = Adoption::find($id);

        if($adoption !== null)
        {
            $adoption->load('rabbits', 'adoptiveMother', 'whelping');

            return new AdoptionResource($adoption);
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
