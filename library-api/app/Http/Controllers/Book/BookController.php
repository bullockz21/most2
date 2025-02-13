<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Modules\Books\DTO\CreateBookRequestDTO;
use App\Modules\Books\UseCase\CreateBookUseCase;
use App\Modules\Books\Repository\BookRepository;
use App\Http\Requests\Book\CreateBookRequest;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct(
        private CreateBookUseCase $createBookUseCase,
        private BookRepository $bookRepository
    ) {}

    // Создание книги: POST /librarian/books
    public function store(CreateBookRequest $request)
    {
        $dto = new CreateBookRequestDTO(
            $request->title,
            $request->author,
            $request->description,
            $request->total_copies,
            $request->available_copies
        );

        $book = $this->createBookUseCase->execute($dto);

        return new BookResource($book);
    }

    // Просмотр списка книг: GET /librarian/books
    public function index()
    {
        $books = $this->bookRepository->getAll();
        return BookResource::collection($books);
    }

    // Обновление книги: PUT /librarian/books/{book}
    public function update(Request $request, Book $book)
    {
        $data = $request->only(['title', 'author', 'description', 'total_copies', 'available_copies']);
        $updatedBook = $this->bookRepository->update($book, $data);
        return new BookResource($updatedBook);
    }

    // Удаление книги: DELETE /librarian/books/{book}
    public function destroy(Book $book)
    {
        $this->bookRepository->delete($book);
        return response()->json(['message' => 'Книга удалена']);
    }
}
