<?php

namespace App\Http\Controllers\Api\Rabbit;

use App\Models\Rabbit;
use App\Models\Pairing;
use App\Models\Whelping;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Responses\ObjectResponse;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;
use App\Http\Requests\RabbitRequest;
use App\Actions\Rabbit\StoreRabbitAction;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\Rabbit\RabbitResource;
use App\Http\Resources\Rabbit\RabbitCollection;
use App\Http\Requests\Rabbit\ValideRabbitRequest;
use App\Responses\Rabbit\RabbitCollectionResponse;
use App\Http\DataTransfertObject\Rabbit\RabbitData;
use App\Http\Requests\Rabbit\GetRabbitByCategoryRequest;
use App\Http\Requests\Rabbit\GetRabbitSameFatherRequest;
use App\Http\Requests\Rabbit\GetRabbitSameMotherRequest;
use App\Http\Requests\Rabbit\GetRabbitSamePairentsRequest;
use DB;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;

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

            $rabbit->load(
                'weaning', 
                'adoption',
                'whelping',
                'whelping.pairing',
                'whelping.pairing.father', 
                'whelping.pairing.mother',
                'whelping.pairing.mother.whelping',
                'whelping.pairing.mother.whelping');

            return response()->json(['data' => $rabbit->toArray()], status: 200);

            /* return new RabbitResource(
                resource: $rabbit
            ); */
        }
        else 
        {
            return response()->json(['message' => "no content"], status: 204);
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
            ->where('isParent', 1)
            ->with('whelping', 'weaning', 'adoption')
            ->orderBy('whelping_date', 'desc')
            ->get();

        return new RabbitCollection(resource: $rabbits);
    }

    public function malesRabbits()
    {
        $rabbits = Rabbit::where('gender', 'Mal')
            ->where('isParent', 1)
            ->with('whelping', 'weaning', 'adoption')
            ->orderBy('whelping_date', 'desc')
            ->get();

        return new RabbitCollection(resource: $rabbits);
    }

    public function rabbitPerAge(GetRabbitByCategoryRequest $request)
    {
        $minMonth = $request->validated('min_month');
        $maxMonth = $request->validated('max_month');

        $query = Rabbit::where('isParent', 0)
            ->with('weaning', 'whelping')
            ->orderBy('whelping_date', 'desc');

        // Filtrage des lapins en fonction de minMonth
        if (!is_null($minMonth)) {
            $minDate = Carbon::now()->subMonths($minMonth)->startOfDay();
            $query->where('whelping_date', '<=', $minDate);
        }


        // Filtrage des lapins en fonction de maxMonth
        if (!is_null($maxMonth)) {
            $maxDate = Carbon::now()->subMonths($maxMonth)->endOfDay();
            $query->where('whelping_date', '>=', $maxDate);
        }


        $rabbits = $query->get();

        return new RabbitCollection(resource: $rabbits);

    }



    public function compatibleRabbitsForPairingHalfBrothers(ValideRabbitRequest $request)
    {
        /** @var Rabbit */  
        $rabbit = Rabbit::find($request->validated('rabbit_id'));

        $motherId = optional($rabbit->whelping)->pairing->mother_id;

        $rabbits = Rabbit::whereDoesntHave('whelping.pairing.mother', function (Builder $builder) use ($motherId) {
            $builder->where('id', '=', $motherId);
        })
        ->where('gender', '!=', $rabbit->gender)
        ->get();

        return new RabbitCollection($rabbits);
                    
    }


    function getNonConsanguineousRabbits(ValideRabbitRequest $request)
    {

        $rabbit = Rabbit::find($request->validated('rabbit_id'));

        $rabbits =  Rabbit::where('id', '!=', $rabbit->id)

            ->whereDoesntHave('whelping.pairing.mother', function ($query) use ($rabbit) {
                $query->where('mother_id', '=', optional(optional($rabbit->whelping)->pairing)->mother_id);
            })

            ->whereDoesntHave('whelping.pairing.father', function ($query) use ($rabbit) {
                $query->where('father_id', '=', optional(optional($rabbit->whelping)->pairing)->father_id);
            })

            ->where('gender', '!=', $rabbit->gender)

            ->get();

        return new RabbitCollection($rabbits);
    }



    function getNonConsanguineousRabbitsAncestor(ValideRabbitRequest $request)
    {

        $rabbit = Rabbit::find($request->validated('rabbit_id'));


        $rabbits =  Rabbit::where('id', '!=', $rabbit->id)
            ->where(function ($query) use ($rabbit) {
                $query->where(function ($query) use ($rabbit) {
                    $query->whereDoesntHave('whelping.pairing', function ($query) use ($rabbit) {
                        $query->whereHas('mother', function ($query) use ($rabbit) {
                            $query->where('id', '=', optional(optional(optional($rabbit->whelping)->pairing)->mother)->id);
                        });
                    });
                })->where(function ($query) use ($rabbit) {
                    $query->whereDoesntHave('whelping.pairing', function ($query) use ($rabbit) {
                        $query->whereHas('father', function ($query) use ($rabbit) {
                            $query->where('id', '=', optional(optional(optional($rabbit->whelping)->pairing)->father)->id);
                        });
                    });
                })->orWhere(function ($query) use ($rabbit) {
                    $query->where(function ($query) use ($rabbit) {
                        $query->whereDoesntHave('whelping.pairing', function ($query) use ($rabbit) {
                            $query->whereHas('mother', function ($query) use ($rabbit) {
                                $query->where(function ($query) use ($rabbit) {
                                    $query->whereDoesntHave('whelping.pairing', function ($query) use ($rabbit) {
                                        $query->whereHas('mother', function ($query) use ($rabbit) {
                                            $query->where('id', '=', optional(optional(optional($rabbit->whelping)->pairing)->mother)->id);
                                        });
                                    });
                                });
                            });
                        });
                    });
                })->orWhere(function ($query) use ($rabbit) {
                    $query->whereDoesntHave('whelping.pairing', function ($query) use ($rabbit) {
                        $query->whereHas('father', function ($query) use ($rabbit) {
                            $query->where(function ($query) use ($rabbit) {
                                $query->whereDoesntHave('whelping.pairing', function ($query) use ($rabbit) {
                                    $query->whereHas('father', function ($query) use ($rabbit) {
                                        $query->where('id', '=', optional(optional(optional($rabbit->whelping)->pairing)->father)->id);
                                    });
                                });
                            });
                        });
                    });
                });
            })
            ->where('gender', '!=', $rabbit->gender)
            ->get();
        
            return new RabbitCollection($rabbits);
        
    }

    function haveCommonParents(Rabbit $rabbit1, Rabbit $rabbit2): bool
    {
        // Vérifier les parents de rabbit1
        $mother1Id = optional(optional($rabbit1->whelping)->pairing)->mother_id;
        $father1Id = optional(optional($rabbit1->whelping)->pairing)->father_id;

        // Vérifier les parents de rabbit2
        $mother2Id = optional(optional($rabbit2->whelping)->pairing)->mother_id;
        $father2Id = optional(optional($rabbit2->whelping)->pairing)->father_id;

        // Vérifier si les lapins ont des parents en commun
        if (($mother1Id === $mother2Id && $mother1Id !== null) ||
            ($father1Id === $father2Id && $father1Id !== null)) {
            return true;
        }

        return false;
    }


    function haveCommonAncestors(Rabbit $rabbit1, Rabbit $rabbit2): bool
    {
        $ancestors1 = collect([$rabbit1]);
        while ($rabbit1->whelping) {
            $rabbit1 = $rabbit1->whelping->pairing->mother;
            $ancestors1->push($rabbit1);
        }

        while ($rabbit2->whelping) {
            $rabbit2 = $rabbit2->whelping->pairing->mother;
            if ($ancestors1->contains($rabbit2)) {
                return true;
            }
        }

        return false;
    }
 

}
