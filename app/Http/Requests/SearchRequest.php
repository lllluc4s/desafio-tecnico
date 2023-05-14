<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer o request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Retorna as regras de validação.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * Retorna as mensagens de validação.
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Por favor, informe um nome de usuário.',
            'username.string'   => 'O campo nome de usuário deve ser uma string.',
        ];
    }
}
