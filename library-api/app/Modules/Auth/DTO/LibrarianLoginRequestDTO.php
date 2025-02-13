<?php

namespace App\Modules\Auth\DTO;

readonly class LibrarianLoginRequestDTO
{
    public function __construct(
        public string $email,
        public string $password,
    ) {}
}
