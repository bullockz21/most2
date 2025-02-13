<?php

namespace app\Modules\CRUD\Repository;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
class GetAllBooksRepository
{
    public function getAll(): Collection
    {
        return Book::all();
    }
}
