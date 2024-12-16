<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'author' => 'required|string',
            'genre' => 'required|string|in:' . implode(',', array_keys(config('book.genres'))),
            'language' => 'required|string|in:' . implode(',', array_keys(config('book.languages'))),
            'availability' => 'required|boolean',
            'description' => 'nullable'
        ];
    }
}
