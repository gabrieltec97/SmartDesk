<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'secondName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'profile' => ['required', 'string', 'in:Administrador,Operador'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Usuário não cadastrado. O nome do usuário é obrigatório.',
            'secondName.required' => 'Usuário não cadastrado. O sobrenome do usuário é obrigatório.',
            'email.required' => 'Usuário não cadastrado. O e-mail do usuário é obrigatório.',
            'email.unique' => 'E-mail já em uso no sistema!', // Esta é para a validação de e-mail duplicado
            'password.required' => 'Usuário não cadastrado. A senha do usuário é obrigatória',
            'profile.required' => 'Usuário não cadastrado. É necessário escolher um perfil para o usuário',
            'profile.in' => 'Perfil inválido. Escolha entre Administrador ou Operador.', // Mensagem para a regra 'in'
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.', // Exemplo: se você quiser uma mensagem para o "min"
        ];
    }
}
