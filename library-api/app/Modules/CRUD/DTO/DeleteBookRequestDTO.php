<?php

namespace app\Modules\CRUD\DTO;

class DeleteBookRequestDTO
{
    public function __construct(
        public int $bookId
    ) {}
}
