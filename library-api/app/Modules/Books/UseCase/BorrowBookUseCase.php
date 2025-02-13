<?php

namespace App\Modules\Books\UseCase;

use App\Modules\Books\DTO\BorrowBookRequestDTO;
use App\Modules\Books\Repository\BookRepository;
use App\Modules\Books\Repository\BorrowedBookRepository;
use Exception;

class BorrowBookUseCase
{
    public function __construct(
        private BookRepository $bookRepository,
        private BorrowedBookRepository $borrowedBookRepository
    ) {}

    public function execute(BorrowBookRequestDTO $dto): array
    {
        $book = $this->bookRepository->getBookById($dto->bookId);
        if (!$book) {
            throw new Exception("Книга не найдена");
        }
        if ($book->available_copies < 1) {
            throw new Exception("Нет доступных копий");
        }

        // Создаем запись о заимствовании через репозиторий
        $this->borrowedBookRepository->createBorrowRecord($dto->userId, $dto->bookId);
        // Уменьшаем количество доступных копий через репозиторий
        $this->bookRepository->decrementAvailableCopies($book);

        return ['message' => 'Книга успешно взята'];
    }
}
