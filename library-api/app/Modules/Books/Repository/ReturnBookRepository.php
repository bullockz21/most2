<?php

namespace App\Modules\Books\Repository;

use App\Models\Book;
use App\Models\BorrowedBook;
use Carbon\Carbon;

class ReturnBookRepository
{
    /**
     * Получает активную (не возвращённую) запись заимствования для указанного пользователя и книги.
     *
     * @param int $userId
     * @param int $bookId
     * @return BorrowedBook|null
     */
    public function getActiveBorrow(int $userId, int $bookId): ?BorrowedBook
    {
        return BorrowedBook::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->first();
    }

    /**
     * Помечает запись заимствования как возвращённую, обновляя дату возврата.
     *
     * @param BorrowedBook $borrowedBook
     * @return void
     */
    public function markAsReturned(BorrowedBook $borrowedBook): void
    {
        $borrowedBook->update(['returned_at' => Carbon::now()]);
    }

    /**
     * Получает книгу по её ID.
     *
     * @param int $bookId
     * @return Book|null
     */
    public function getBookById(int $bookId): ?Book
    {
        return Book::find($bookId);
    }

    /**
     * Увеличивает количество доступных копий книги.
     *
     * @param Book $book
     * @return void
     */
    public function incrementAvailableCopies(Book $book): void
    {
        $book->increment('available_copies');
    }
}
