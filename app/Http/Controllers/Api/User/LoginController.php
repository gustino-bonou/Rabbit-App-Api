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
            // Authentification réussie
            $user = User::find(Auth::user()->id);
            return response()->json(['message' => 'Login successful', 'jeton' => $user->createToken('user_token')->plainTextToken], 200);
        }
        else
        {
            // Authentification échouée
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
    }
}
