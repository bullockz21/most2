<?php

namespace app\Http\Requests\CRUD;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Если маршрут защищён JWT, то здесь можно вернуть true
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
