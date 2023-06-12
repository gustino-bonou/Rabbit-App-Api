<?php

namespace App\Actions\User;

use App\Models\User;

class RegisterUserAction
{
    public function handle(
        $first_name,
        $email,
        $password,
        $last_name,
        $phone,
        
    ): void {
        User::create([
            'first_name' => $first_name,
            'email' => $email,
            'password' => $password,
            'last_name' => $last_name,
            'phone' => $phone,  
        ]);
    }
}
