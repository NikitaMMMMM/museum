<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'max:255',
                'unique:users',
                'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/',
            ],
            'avatar_url' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
            'agreement' => ['accepted', 'required'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.max' => 'Имя не может превышать 255 символов.',

            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.string' => 'Email должен быть строкой.',
            'email.email' => 'Введите корректный email адрес.',
            'email.max' => 'Email не может превышать 255 символов.',
            'email.unique' => 'Этот email уже зарегистрирован.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.min' => 'Пароль должен содержать минимум 8 символов.',
            'password.mixed_case' => 'Пароль должен содержать буквы.', 
            'password.numbers' => 'Пароль должен содержать хотя бы одну цифру.',
            'password.symbols' => 'Пароль должен содержать хотя бы один специальный символ.',

            'agreement.required' => 'Вы должны принять условия пользовательского соглашения.',
            'agreement.accepted' => 'Вы должны принять условия пользовательского соглашения.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'имя',
            'email' => 'email',
            'password' => 'пароль',
            'agreement' => 'согласие с условиями',
        ];
    }
}
