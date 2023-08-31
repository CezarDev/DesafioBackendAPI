<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Services\ClienteService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index()
    {
        $clientes = Cliente::get();

        return response()->json(['clientes' => $clientes]);
    }

    public function store(ClienteRequest $request)
    {
        try {
            $cliente = $this->clienteService->salvarCliente($request);

        }catch (Exception $exception) {

            $erro = $exception->getMessage();
            return response()->json(['message' => $erro], 500);
        }

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso',
            'cliente' => $cliente
        ], 201);
    }

    public function show(string $id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

        return response()->json([ 'cliente' => $cliente ]);
    }


    public function update(Request $request, string $id)
    {
        $cliente = $this->clienteService->buscarClientePeloId($id);

        if (!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

        $validator = Validator::make($request->all(), [
            'nome'      => 'required',
            'cpf'       => 'required',
            'email'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' =>  $validator->errors()]);
        }

        try {
            $cliente = $this->clienteService->atualizarCliente($request,$id);

        } catch (Exception $exception) {

            $erro = $exception->getMessage();
            return response()->json(['message' => $erro], 500);
        }

        return response()->json([
            'message' => 'Cliente atualizado com sucesso',
            'cliente' => $cliente
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = $this->clienteService->buscarClientePeloId($id);

        if (!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

       $clientes = $this->clienteService->excluirCliente($cliente);

        return response()->json([
            'message' => 'Cliente excluído com sucesso',
            'clientes' => $clientes
        ]);
    }
}
