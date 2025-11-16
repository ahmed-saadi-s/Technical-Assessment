<?php

namespace App\Http\Requests\Authentication;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email.',
            
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 8 characters.',
        ];
    }
}
