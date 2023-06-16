<?php

namespace App\Http\Controllers\Api\User;

use DB;
use Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Stancl\Tenancy\Contracts\Tenant;
use App\Actions\User\RegisterUserAction;
use App\Http\Requests\RegistreUserRequest;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\DataTransfertObject\User\RegisterUserData;

class RegistreUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegistreUserRequest $request)
    {
        DB::beginTransaction();
        $dto = new RegisterUserData(
            firstName: $request->validated('first_name'),
            lastName: $request->validated('last_name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            password: $request->validated('password')
        );

        $user = (new RegisterUserAction)->handle(
            ...$dto->toArray()
        );

        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password'),
        ];

        if (Auth::attempt($credentials))
        {
            // Authentification réussie

            $tenant = \App\Models\Tenant::create([
                'id' => Str::slug($user->first_name . $user->last_name . $user->id),
                'name' => $user->last_name. $user->id
            ]);


            $tenant->domains()->create([
                'domain' => Str::substr($user->first_name, 0, 3). $user->id  . '.'  .'localhost'
            ]);

            
            $user->tenant()->associate($tenant);

            $token = $user->createToken('auth_token')->plainTextToken;

            $user->authToken = $token;

            $user->save();

        return response()->json(['message' => 'ok', 'your-api-key' => $token,]);

        } else 
        {
            throw new HttpResponseException(response()->json([
                "error" => true,
                "message" => "Data not valid",
            ], 422));
        }   
    }
}
