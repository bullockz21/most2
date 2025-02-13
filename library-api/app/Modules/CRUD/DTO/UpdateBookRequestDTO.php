<?php

namespace app\Modules\CRUD\DTO;

class UpdateBookRequestDTO
{
    public function __construct(
        public ?string $title,
        public ?string $author,
        public ?string $description,
        public ?int $total_copies,
        public ?int $available_copies
    ) {}
}
