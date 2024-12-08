<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:8|confirmed'
        ];

        if($this->getMethod() === 'PUT')
        {
            $rules['email'] = $rules['email']  . Auth::user()->id;
        }

        return $rules;
    }
}
