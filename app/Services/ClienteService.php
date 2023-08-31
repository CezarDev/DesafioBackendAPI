<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Produto;

class ClienteService
{
    public function salvarCliente($request)
    {
        $cliente = new Cliente([
            'nome'            => $request->nome,
            'cpf'             => $request->cpf,
            'email'           => $request->email,
            'primeira_compra'  => $request->primeira_compra ?? true,
        ]);

        $cliente->save();

        return $cliente;
    }

    public function atualizarCliente($request, $id)
    {
        return Cliente::updateOrCreate(
            ['id' => $id],
            [
                'nome'  => $request->nome,
                'cpf'   => $request->cpf,
                'email' => $request->email,
            ]
        );
    }

    public function excluirCliente($cliente)
    {
        $cliente->delete();

        return Cliente::get();
    }

    public function buscarClientePeloId($id)
    {
        return Cliente::find($id);
    }
}
