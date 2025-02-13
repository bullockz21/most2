<?php

namespace App\Modules\Books\DTO;

readonly class CreateBookRequestDTO
{
    public function __construct(
        public string $title,
        public string $author,
        public ?string $description,
        public int $total_copies,
        public int $available_copies
    ) {}
}
