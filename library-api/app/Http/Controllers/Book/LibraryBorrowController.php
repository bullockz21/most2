<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Modules\Books\DTO\BorrowBookRequestDTO;
use App\Modules\Books\UseCase\BorrowBookUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryBorrowController extends Controller
{
    private BorrowBookUseCase $borrowBookUseCase;

    public function __construct(BorrowBookUseCase $useCase)
    {
        $this->borrowBookUseCase = $useCase;
    }

    // Этот контроллер invokable: вызывается методом __invoke
    public function __invoke(Request $request, $bookId)
    {
        // Получаем идентификатор текущего пользователя через Auth
        $userId = Auth::id();
        // Создаем DTO с данными
        $dto = new BorrowBookRequestDTO((int)$bookId, $userId);

        try {
            $result = $this->borrowBookUseCase->execute($dto);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
