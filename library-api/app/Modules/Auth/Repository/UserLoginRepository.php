<?php

namespace App\Modules\Auth\Repository;

use App\Models\User;
use App\Modules\Auth\DTO\UserLoginRequestDTO;
use App\Modules\Auth\Repository\Exceptions\PasswordDoesntMatchExpetion;
use App\Modules\Auth\Repository\Exceptions\UserDontExistsException;
use Illuminate\Support\Facades\Hash;

class UserLoginRepository
{
    public function __construct(
        private ?User $user = null,
    )
    {
    }

    public function make(UserLoginRequestDTO $dto): array
    {
        // Поиск пользователя по email
        $this->user = User::where('email', '=', $dto->email)->first();

        if (!$this->user) {
            throw new UserDontExistsException();
        }

        // Проверка соответствия введённого пароля и хеша, сохранённого в базе
        if (!Hash::check($dto->password, $this->user->password)) {
            throw new PasswordDoesntMatchExpetion();
        }

        // Создание токена (например, используя Laravel Sanctum)
        return [
            'token' => $this->user->createToken('auth-token')->plainTextToken,
        ];
    }
}
