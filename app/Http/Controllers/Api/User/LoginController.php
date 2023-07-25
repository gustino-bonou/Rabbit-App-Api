<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->validated('email'),
            'password' => $request->validated('password') 
        ];

        if (Auth::attempt($credentials))
        {

            $id = $request->user()->id;

            $user = User::find($id);


            $token = $user->createToken('auth_token')->plainTextToken;

            $user->authToken = $token;

            $user->save();

            return response()->json( 
                [
                    'message' => "Register successfully", 
                    'token' => $token, 
                    "user" => $user->toArray()
                ],

                status: 200);

        }
        else
        {
            // Authentification échouée
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
