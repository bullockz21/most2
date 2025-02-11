<?php

namespace App\Presenter;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class JsonPresenter
{
    public function present(mixed $response): JsonResponse
    {
        return response()->json($response)->setStatusCode(Response::HTTP_OK);
    }
}
