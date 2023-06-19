<?php

namespace App\Http\Controllers\Api\Rabbit;

use App\Models\Rabbit;
use App\Models\Pairing;
use App\Models\Whelping;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\RabbitRequest;
use App\Actions\Rabbit\StoreRabbitAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Rabbit\RabbitCollection;
use App\Http\Requests\Rabbit\ValideRabbitRequest;
use App\Http\DataTransfertObject\Rabbit\RabbitData;
use App\Http\Requests\Rabbit\GetRabbitSameFatherRequest;
use App\Http\Requests\Rabbit\GetRabbitSameMotherRequest;
use App\Http\Requests\Rabbit\GetRabbitSamePairentsRequest;
use App\Responses\ObjectResponse;
use App\Responses\Rabbit\RabbitCollectionResponse;

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
    public function show(string $id)
    {
        $rabbit = Rabbit::find($id);

        if($rabbit !== null) 
        {

            $rabbit->load('weaning', 'adoption', 'whelping');

            return response()->json(['data' => $rabbit->toArray()], status: 200);

            /* return new RabbitResource(
                resource: $rabbit
            ); */
        }
        else 
        {
            return response()->json( status: 204);
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

    public function getRabbitSameMother(GetRabbitSameMotherRequest $request): RabbitCollection
    {
        $femalRabbit = $request->validated('mother_id');

        $rabbits = Rabbit::whereHas('whelping.pairing.mother', function (Builder $builder) use ($femalRabbit) {
            $builder->where('id', $femalRabbit);
        })->with('whelping', 'weaning', 'adoption');


        return new RabbitCollection(
            $rabbits->paginate(15)
        );

    }
    public function getRabbitSameFather(GetRabbitSameFatherRequest $request): RabbitCollection
    {
        $maleRabbit = $request->validated('father_id');

        $rabbits = Rabbit::whereHas('whelping.pairing.father', function (Builder $builder) use ($maleRabbit) {
            $builder->where('id', $maleRabbit);
        })->with('whelping', 'weaning', 'adoption');


        return new RabbitCollection(
            $rabbits->paginate(15)
        );

    }
    public function getRabbitParents(ValideRabbitRequest $request)
    {
        /** @var Rabbit */
        $rabbit = $request->validated('rabbit_id');

        $rabbit = Rabbit::find($rabbit);

        /** @var Whelping */
        if(!$rabbit || $rabbit->whelping === null)
        {
            return response()->json(['data' => null]);
        }
        
        $rabbitMother = $rabbit->getMother->load('whelping', 'weaning', 'adoption');
        $rabbitFather = $rabbit->getFather->load('whelping', 'weaning', 'adoption');

        return new RabbitCollection(resource: ['mother' => $rabbitMother, 'father' => $rabbitFather]);
        
    }

    public function getRabbitSameParents(GetRabbitSamePairentsRequest $request)
    {
        $mother_id = $request->validated('mother_id');
        $father_id = $request->validated('father_id');

        
        $rabbits = Rabbit::whereHas('whelping', function (Builder $builder) use ($father_id, $mother_id){
            $builder->whereHas('pairing', function (Builder $builder) use ($mother_id, $father_id) {
                $builder->where('mother_id', $mother_id)->where('father_id', $father_id);
            });
        })->paginate(15)->load('whelping', 'weaning', 'adoption');

        return new RabbitCollection(resource: $rabbits);
    
    }

    public function compatibleRabbitsForPairing(ValideRabbitRequest $request)
    {
        /** @var Rabbit */  
        $rabbit = Rabbit::find($request->validated('rabbit_id'));

        $rabbits = Rabbit::whereDoesntHave('whelping.pairing.mother', function (Builder $builder) use ($rabbit){
            $builder->where('id', '!=', $rabbit->whelping->pairing->mother_id);
        })
        ->whereDoesntHave('whelping.pairing.father', function (Builder $builder) use ($rabbit){
            $builder->where('id', '!=', $rabbit->whelping->pairing->father_id);
        })
        ->where('gender', '!=', $rabbit->gender)
        ->paginate(15)->load('whelping', 'weaning', 'adoption');

        return new RabbitCollection($rabbits);
                    
    }

    public function femalesRabbits()
    {
        $rabbits = Rabbit::where('gender', 'Femelle')
            ->with('whelping', 'weaning', 'adoption')
            ->paginate(15);

        return new RabbitCollection(resource: $rabbits);
    }

    public function malesRabbits()
    {
        $rabbits = Rabbit::where('gender', 'Mal')
            ->with('whelping', 'weaning', 'adoption')
            ->paginate(15);

        return new RabbitCollection(resource: $rabbits);
    }

    public function compatibleRabbitsForPairingHalfBrothers(ValideRabbitRequest $request)
    {
        /** @var Rabbit */  
        $rabbit = Rabbit::find($request->validated('rabbit_id'));

        $rabbits = Rabbit::whereDoesntHave('whelping.pairing.mother', function (Builder $builder) use ($rabbit){
            $builder->where('id', '!=', $rabbit->whelping->pairing->mother_id);
        })
        ->where('gender', '!=', $rabbit->gender)
        ->paginate(15)->load('whelping', 'weaning', 'adoption');

        return new RabbitCollection($rabbits);
                    
    }
 

}
