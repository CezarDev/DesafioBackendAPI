<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaRequest extends FormRequest
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
    public function rules()
    {
        return [
            'cliente.nome' => 'required',
            'cliente.cpf' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'cliente.nome' => "NOME OBRIGATÓRIO",
            'cliente.cpf'  => "CPF OBRIGATÓRIO",
        ];
    }
}
