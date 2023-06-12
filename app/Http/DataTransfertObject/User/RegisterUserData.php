<?php

namespace App\Http\DataTransfertObject\User;

use Hash;

class RegisterUserData
{
    public function __construct(
        private readonly string $lastName,
        private readonly string $firstName,
        private readonly string $email,
        private readonly string $phone,
        private readonly string $password,
    ){}

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
        ];
    }
}
