<?php

namespace App\Http\Controllers\Api\User;

use App\Actions\User\RegisterUserAction;
use App\Http\Controllers\Controller;
use App\Http\DataTransfertObject\User\RegisterUserData;
use App\Http\Requests\RegistreUserRequest;
use Illuminate\Http\Request;

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

        $user = (new RegisterUserAction)->handle(
            ...$dto->toArray()
        );

       return response()->json(['message' => 'Register successfully', 'token' => $user->createToken('auth_token')->plainTextToken ]);
    }
}
