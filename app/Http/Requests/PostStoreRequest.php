<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:post,name',
            'description' => 'required|string|min:10|max:1000',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'name.unique' => 'This name already exists.',
            'name.max' => 'Name is too long.',

            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',
        ];
    }
}
