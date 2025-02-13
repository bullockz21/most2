<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Здесь можно проверить роль: библиотекарь или другой способ аутентификации
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => 'required|string|max:255',
            'author'           => 'required|string|max:255',
            'description'      => 'nullable|string',
            'total_copies'     => 'required|integer|min:1',
            'available_copies' => 'required|integer|min:0',
        ];
    }
}
