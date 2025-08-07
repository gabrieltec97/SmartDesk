<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // A instância do usuário que está sendo atualizado é acessível via $this->route('usuario')
        // Supondo que o parâmetro de rota é 'usuario'. Se for 'user', use $this->route('user').
        $userId = $this->route('usuario')->id; // Ou $this->route('user')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'secondName' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // A regra 'unique' agora ignora o e-mail do próprio usuário que está sendo atualizado
                Rule::unique('users')->ignore($userId),
            ],
            // Adicione 'nullable' se a senha não for obrigatória na atualização
            'password' => ['nullable', 'string', 'min:8', 'confirmed'], // Adicione 'confirmed' se você tiver um campo password_confirmation
            'profile' => ['required', 'string', 'in:Administrador,Operador'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Usuário não cadastrado. O nome do usuário é obrigatório.',
            'secondName.required' => 'Usuário não cadastrado. O sobrenome do usuário é obrigatório.',
            'email.required' => 'Usuário não cadastrado. O e-mail do usuário é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'E-mail já em uso no sistema!', // Esta mensagem é para a regra 'unique'
            'password.min' => 'A senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
            'profile.required' => 'Usuário não cadastrado. É necessário escolher um perfil para o usuário',
            'profile.in' => 'Perfil inválido. Escolha entre Administrador ou Operador.',
        ];
    }
}
