<?php

namespace app\Http\Controllers\CRUD;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Modules\CRUD\UseCase\CreateBookUseCase;
use App\Modules\CRUD\DTO\CreateBookRequestDTO;
use App\Http\Requests\CRUD\CreateBookRequest;



class BookController extends Controller
{
    private CreateBookUseCase $createBookUseCase;

    public function __construct(CreateBookUseCase $useCase)
    {
        $this->createBookUseCase = $useCase;
    }

    public function __invoke(CreateBookRequest $request)
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
}
