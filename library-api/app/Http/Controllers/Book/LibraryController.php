<?php

namespace App\Http\Controllers\Book;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Modules\Books\DTO\GetAvailableBooksRequestDTO;
use App\Modules\Books\UseCase\GetAvailableBooksUseCase;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    private GetAvailableBooksUseCase $getAvailableBooksUseCase;

    public function __construct(GetAvailableBooksUseCase $useCase)
    {
        $this->getAvailableBooksUseCase = $useCase;
    }

    public function __invoke(Request $request)
    {
        $dto = new GetAvailableBooksRequestDTO();
        $books = $this->getAvailableBooksUseCase->execute($dto);
        return BookResource::collection($books);
    }
}
