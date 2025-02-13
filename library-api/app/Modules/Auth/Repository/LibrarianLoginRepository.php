<?php

namespace App\Modules\Auth\Repository;

use App\Models\Librarian;
use App\Modules\Auth\DTO\LibrarianLoginRequestDTO;
use App\Modules\Auth\Repository\Exceptions\PasswordDoesntMatchException;
use App\Modules\Auth\Repository\ExceptionsLib\LibrarianDoesNotExistException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class LibrarianLoginRepository
{
    public function make(LibrarianLoginRequestDTO $dto): array
    {
        $librarian = Librarian::where('email', $dto->email)->first();

        if (!$librarian) {
            throw new LibrarianDoesNotExistException("Библиотекарь не найден.");
        }

        if (!Hash::check($dto->password, $librarian->password)) {
            throw new PasswordDoesntMatchException("Неверный пароль.");
        }

        $token = JWTAuth::fromUser($librarian);

        return ['token' => $token];
    }
}
