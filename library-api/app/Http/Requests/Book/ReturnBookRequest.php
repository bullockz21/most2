<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class ReturnBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Дополнительная авторизация может быть проверена через middleware, поэтому возвращаем true
        return true;
    }

    public function rules(): array
    {
        // Если дополнительных данных в теле запроса не передается (параметр {book} берется из URL),
        // можно вернуть пустой массив.
        return [];
    }
}
