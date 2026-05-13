<?php

namespace App\Http\Requests\Auth;

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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.string' => 'Email должен быть строкой.',
            'email.email' => 'Введите корректный email адрес.',
            'email.max' => 'Email не может превышать 255 символов.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => 'email',
            'password' => 'пароль',
            'remember' => 'запомнить меня',
        ];
    }
}