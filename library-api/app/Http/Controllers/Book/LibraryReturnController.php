<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\ReturnBookRequest;
use App\Modules\Books\DTO\ReturnBookRequestDTO;
use App\Modules\Books\UseCase\ReturnBookUseCase;
use App\Http\Resources\ReturnBookResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryReturnController extends Controller
{
    private ReturnBookUseCase $returnBookUseCase;

    public function __construct(ReturnBookUseCase $useCase)
    {
        $this->returnBookUseCase = $useCase;
    }

    // Invokable контроллер для возврата книги: POST /api/v1/user/books/{book}/return
    public function __invoke(ReturnBookRequest $request, $book)
    {
        // Получаем ID аутентифицированного пользователя
        $userId = Auth::id();

        // Создаем DTO для возврата книги (приводим book к целому числу)
        $dto = new ReturnBookRequestDTO((int)$book, $userId);

        try {
            $result = $this->returnBookUseCase->execute($dto);
            // Оборачиваем результат в ресурс ReturnBookResource
            return new ReturnBookResource((object)$result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
