<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name'     => ['required','string','max:255','regex:/^[\pL\s\-\'.]+$/u',],
            'email'    => ['required','email:rfc,dns','unique:users,email','max:255','lowercase',],
            'password' => ['required','string','min:8','max:72','confirmed','not_regex:/^\s|\s$/',],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Full name is required.',
            'name.max'           => 'Name cannot exceed 255 characters.',
            'name.regex'         => 'Name contains invalid characters.',

            'email.required'     => 'Email is required.',
            'email.email'        => 'Enter a valid email address.',
            'email.unique'       => 'This email is already registered.',
            'email.lowercase'    => 'Email must be in lowercase.',

            'password.required'  => 'Password is required.',
            'password.min'       => 'Password must be at least 8 characters.',
            'password.max'       => 'Password cannot exceed 72 characters.',
            'password.confirmed' => 'Passwords do not match.',
            'password.not_regex' => 'Password must not start or end with spaces.',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $password = $this->input('password');

            if (!$password || $validator->errors()->has('password')) {
                return;
            }

            if (!preg_match('/[A-Z]/', $password)) {
                $validator->errors()->add('password', 'Password must contain at least one uppercase letter.');
            }

            if (!preg_match('/[a-z]/', $password)) {
                $validator->errors()->add('password', 'Password must contain at least one lowercase letter.');
            }

            if (!preg_match('/[0-9]/', $password)) {
                $validator->errors()->add('password', 'Password must contain at least one number.');
            }

            if (!preg_match('/[\W_]/', $password)) {
                $validator->errors()->add('password', 'Password must contain at least one special character.');
            }
        });
    }
    
}
