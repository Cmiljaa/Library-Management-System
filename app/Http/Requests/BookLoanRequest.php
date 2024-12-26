<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|string|in:' . implode(',', array_keys(config('book.statuses'))),
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id'
        ];
    }
}
