<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'rating' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string|max:10000'
        ];
    }
}