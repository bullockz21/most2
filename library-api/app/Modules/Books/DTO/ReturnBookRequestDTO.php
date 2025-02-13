<?php

namespace App\Modules\Books\DTO;

readonly class ReturnBookRequestDTO
{
    public function __construct(
        public int $bookId,
        public int $userId
    ) {}
}
