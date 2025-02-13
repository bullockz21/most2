<?php
namespace App\Modules\Auth\Repository;

use App\Models\User;
use App\Modules\Auth\DTO\UserLoginRequestDTO;
use App\Modules\Auth\Repository\Exceptions\PasswordDoesntMatchException;
use App\Modules\Auth\Repository\Exceptions\UserNotFoundException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class UserLoginRepository
{
    public function login(UserLoginRequestDTO $dto): array
    {
        $user = User::where('email', $dto->email)->first();
        if (!$user) {
            throw new UserNotFoundException('Пользователь не найден');
        }
        if (!Hash::check($dto->password, $user->password)) {
            throw new PasswordDoesntMatchException('Пароль не совпадает');
        }

        $token = JWTAuth::fromUser($user);
        return ['token' => $token];
    }
}
