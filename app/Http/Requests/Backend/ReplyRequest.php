<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
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
            'reply' => 'required|string|min:10|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'reply.required' => 'The reply field is required.',
            'reply.string' => 'The reply must be a string.',
            'reply.min' => 'The reply must be at least :min characters.',
            'reply.max' => 'The reply may not be greater than :max characters.',
        ];
    }
}
