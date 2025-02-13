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


    public function __invoke(ReturnBookRequest $request, $book)
    {

        $userId = Auth::id();


        $dto = new ReturnBookRequestDTO((int)$book, $userId);

        try {
            $result = $this->returnBookUseCase->execute($dto);

            return new ReturnBookResource((object)$result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
