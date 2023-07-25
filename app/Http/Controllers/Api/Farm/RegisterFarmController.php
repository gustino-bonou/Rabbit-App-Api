<?php

namespace App\Http\Controllers\Api\Farm;

use App\Actions\Farm\StoreFarmAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransfertObject\Farm\FarmData;
use App\Http\Requests\Farm\FarmRequest;
use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterFarmController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FarmRequest $request)
    {
        /* @var User */
        $user = User::find($request->user()->id);

        if($user->farm_id !== null)
        {
            return response()->json(['messge' => 'vous avez déjà une ferme'], status: 409);
        }

        $dto = new FarmData( 
            name: $request->validated('name'),
            adresse: $request->validated('adresse'),
            user_id: $user->id
        );

        $farm = (new StoreFarmAction)->handle(
            ...$dto->toArray()
        );

        return response()->json(['farm' => $farm->toArray()], status: 200);
    }
}
