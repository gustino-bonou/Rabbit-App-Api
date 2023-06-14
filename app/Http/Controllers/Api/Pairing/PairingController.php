<?php

namespace App\Http\Controllers\Api\Pairing;

use App\Models\Rabbit;
use App\Models\Pairing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Pairing\PairingResource;
use App\Http\Resources\Rabbit\RabbitCollection;

class PairingController extends Controller
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
        $pairing = Pairing::find($id);  

        if($pairing !== null )
        {
            $pairing->load(
                'mother.whelping',
                'mother.weaning',
                'mother.adoption',
                'father.whelping',
                'father.whelping',
                'father.whelping'
            );
            return new PairingResource($pairing);
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

    public function possiblePairings() 
    {
        $rabbits = Rabbit::whereDoesntHave('motherInPairing')
    ->orWhereDoesntHave('fatherInPairing')->with('whelping');


        return new RabbitCollection(
            $rabbits->paginate(15)
        );
    }
}
