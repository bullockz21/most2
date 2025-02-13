<?php

namespace app\Http\Controllers\CRUD;


use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;
use App\Modules\CRUD\DTO\GetAllBooksRequestDTO;
use App\Modules\CRUD\UseCase\GetAllBooksUseCase;
class LibraryAllBooksController extends Controller
{
    private GetAllBooksUseCase $getAllBooksUseCase;

    public function __construct(GetAllBooksUseCase $useCase)
    {
        $this->getAllBooksUseCase = $useCase;
    }

    // Этот метод invokable вызывается при GET /api/v1/librarian/books
    public function __invoke(Request $request)
    {
        // Создаем DTO (без дополнительных параметров)
        $dto = new GetAllBooksRequestDTO();
        // Выполняем UseCase для получения всех книг
        $books = $this->getAllBooksUseCase->execute($dto);
        // Возвращаем коллекцию книг, отформатированную через BookResource
        return BookResource::collection($books);
    }
}
