<?php

namespace App\Http\Controllers\Api\Rabbit;

use App\Actions\Rabbit\StoreRabbitAction;
use App\Http\DataTransfertObject\Rabbit\RabbitData;
use App\Models\Rabbit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rabbit\GetRabbitChildrenRequest;
use App\Http\Requests\RabbitRequest;
use App\Http\Resources\Rabbit\RabbitResource;
use Illuminate\Database\Eloquent\Builder;


class RabbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
    public function store(RabbitRequest $request)
    {

        
  
    }

    /**
     * Display the specified resource.
     */
    public function show(Rabbit $rabbit, )
    {

        return new RabbitResource(Rabbit::with('weaning', 'adoption', 'whelping')->find($rabbit->id));
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

    public function getFemaleRabbitChildren(GetRabbitChildrenRequest $request)
    {
        $femalRabbit = Rabbit::findOrFail($request->validated('mother_id'));
    }
}
