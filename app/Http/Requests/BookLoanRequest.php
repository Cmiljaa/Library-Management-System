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
        $rules = [
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id'
        ];

        if($this->getMethod() === 'PUT')
        {
            $rules['borrow_date'] = 'required|date';
            $rules['return_date'] = 'nullable|after:borrow_date';
        }

        return $rules;
    }
}
