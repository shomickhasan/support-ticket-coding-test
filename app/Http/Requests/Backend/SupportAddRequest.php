<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class SupportAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'issue' => 'required|string|min:10|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'issue.required' => 'The issue details field is required.',
            'issue.string' => 'The issue details must be a string.',
            'issue.min' => 'The issue details must be at least :min characters.',
            'issue.max' => 'The issue details may not be greater than :max characters.',
        ];
    }
}
