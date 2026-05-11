<?php

namespace App\Http\Requests\Requests\Auth;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar_url' => ['string'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
            ],
            'agree_terms' => ['accepted', 'required'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'email.unique' => 'Этот email уже зарегистрирован.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password.uncompromised' => 'Этот пароль был скомпрометирован в утечках данных. Выберите другой.',
            'agree_terms.accepted' => 'Вы должны принять условия использования.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim($this->name),
            'email' => trim(strtolower($this->email)),
        ]);
    }
}
