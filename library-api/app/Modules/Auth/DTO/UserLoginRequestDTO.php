<?php

namespace App\Modules\Auth\DTO;

readonly class UserLoginRequestDTO
{
    public function __construct(
        public string $email,
        public string $password,
    )
    {}
}
