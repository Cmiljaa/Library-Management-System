<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'value' => $this->getValueValidationRule(),
        ];
    }

    protected function getValueValidationRule()
    {
        switch ($this->route('setting')->type)
        {
            case 'integer':
                return 'required|integer|min:2';

            case 'string':
                return 'required|string|min:1|max:255';
            
            default:
                return 'required';
        }
    }
}
