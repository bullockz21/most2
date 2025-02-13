<?php

namespace app\Http\Requests\CRUD;

use Illuminate\Foundation\Http\FormRequest;
class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'            => 'nullable|string|max:255',
            'author'           => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'total_copies'     => 'nullable|integer|min:1',
            'available_copies' => 'nullable|integer|min:0',
        ];
    }
}
