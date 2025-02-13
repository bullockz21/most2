<?php

namespace App\Modules\Auth\DTO;

readonly class UserRegisterRequestDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $password_confirmation,
    ) {}
}
