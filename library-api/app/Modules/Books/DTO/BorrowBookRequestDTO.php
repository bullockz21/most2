<?php

namespace App\Modules\Books\DTO;

readonly class BorrowBookRequestDTO
{
    public function __construct(
        public int $bookId,
        public int $userId
    ) {}
}
