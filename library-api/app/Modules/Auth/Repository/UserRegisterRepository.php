<?php

namespace App\Modules\Auth\Repository;

use App\Models\User;
use App\Modules\Auth\DTO\UserRegisterRequestDTO;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserRegisterRepository
{
    public function register(UserRegisterRequestDTO $dto): array
    {
        $user = User::create([
            'name'     => $dto->name,
            'email'    => $dto->email,
            'password' => Hash::make($dto->password),
        ]);
        $token = JWTAuth::fromUser($user);
        return [
            'user'  => $user,
            'token' => $token,
        ];
    }
}
