<?php

namespace app\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Requests\CRUD\UpdateBookRequest;

use App\Http\Resources\BookResource;
use App\Modules\CRUD\UseCase\UpdateBookUseCase;
use App\Modules\CRUD\DTO\UpdateBookRequestDTO;


class UpdateBookController
{
    private UpdateBookUseCase $updateBookUseCase;

    public function __construct(UpdateBookUseCase $useCase)
    {
        $this->updateBookUseCase = $useCase;
    }

    // Этот контроллер invokable вызывается при PUT /api/v1/librarian/books/{book}
    public function __invoke(UpdateBookRequest $request, $book)
    {
        $dto = new UpdateBookRequestDTO(
            $request->input('title'),
            $request->input('author'),
            $request->input('description'),
            $request->input('total_copies'),
            $request->input('available_copies')
        );

        try {
            $updatedBook = $this->updateBookUseCase->execute((int)$book, $dto);
            return new BookResource($updatedBook);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
