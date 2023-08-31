<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nome'      => 'required|unique:clientes',
            'cpf'       => 'required|unique:clientes',
            'email'     => 'required|unique:clientes|email:rfc',
        ];
    }


    public function messages()
    {
        return [
            'nome.required'  => "NOME OBRIGATÓRIO",
            'cpf.unique'     => "CPF JÁ EXISTE",

            'email.required' => "EMAIL OBRIGATÓRIO",
            'email.unique'   => "EMAIL JÁ EXISTE",
        ];
    }
}
