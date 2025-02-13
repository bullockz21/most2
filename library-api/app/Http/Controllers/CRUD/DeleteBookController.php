<?php

namespace app\Http\Controllers\CRUD;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRUD\DeleteBookRequest;
use App\Modules\CRUD\DTO\DeleteBookRequestDTO;
use App\Modules\CRUD\UseCase\DeleteBookUseCase;
use Illuminate\Http\Request;

class DeleteBookController extends Controller
{
    private DeleteBookUseCase $deleteBookUseCase;

    public function __construct(DeleteBookUseCase $useCase)
    {
        $this->deleteBookUseCase = $useCase;
    }

    public function __invoke(DeleteBookRequest $request, $book)
    {
        $dto = new DeleteBookRequestDTO((int)$book);
        try {
            $result = $this->deleteBookUseCase->execute($dto);
            return response()->json($result, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
