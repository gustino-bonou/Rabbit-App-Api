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
use App\Models\User;

class RegistreUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegistreUserRequest $request)
    {

        $dto = new RegisterUserData(
            firstName: $request->validated('first_name'),
            lastName: $request->validated('last_name'),
            email: $request->validated('email'),
            phone: $request->validated('phone'),
            password: $request->validated('password')
        );

                
            try{
                    $user = (new RegisterUserAction)->handle(
                    ...$dto->toArray()
                );

            

                $credentials = [
                    'email' => $request->validated('email'),
                    'password' => $request->validated('password'),
                ];

    
                if (Auth::attempt($credentials))
                {

                    $id = $user->id;

                    $user = User::find($id);


                    $token = $user->createToken('auth_token')->plainTextToken;

                    $user->authToken = $token;

                    $user->save();

                    return response()->json(
                        ['message' => "Register successfully", 'token' => $token, "user" => $user->toArray()],
                    status: 200);

                }
                  
            } catch(\Exception $e) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                "error" => true,
                "message" => "Data not valid",
                "errorsList" => $e->getMessage()
            ], 422));
            }
        
    }
}
