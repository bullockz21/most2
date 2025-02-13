<?php

namespace App\Modules\Books\Repository;

use App\Models\BorrowedBook;
use Carbon\Carbon;

class BorrowedBookRepository
{
    public function createBorrowRecord(int $userId, int $bookId): void
    {
        BorrowedBook::create([
            'user_id'     => $userId,
            'book_id'     => $bookId,
            'borrowed_at' => Carbon::now(),
        ]);
    }
}
