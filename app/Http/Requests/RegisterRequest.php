<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email', Rule::unique('users', 'email')->ignore(optional($this->user)->id),
            'phone' => 'required|string|max:15',
            'password' => 'required|min:8|confirmed'
        ];
    }
}
