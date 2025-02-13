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


    public function __invoke(Request $request)
    {
        $dto = new GetAllBooksRequestDTO();
        $books = $this->getAllBooksUseCase->execute($dto);
        return BookResource::collection($books);
    }
}
