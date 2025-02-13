<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReturnBookResource extends JsonResource
{
    public function toArray($request)
    {
        // Форматируем ответ с сообщением
        return [
            'message' => $this->message,
        ];
    }
}
