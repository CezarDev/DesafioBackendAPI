<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::get();

        return response()->json(['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|unique:clientes',
            'cpf'       => 'required|unique:clientes',
            'email'     => 'required|unique:clientes|email:rfc',
        ]);

        $cliente = new Cliente([
            'nome'            => $request->nome,
            'cpf'             => $request->cpf,
            'email'           => $request->email,
            'primeira_compra'  => $request->primeira_compra ?? true,
        ]);

        $cliente->save();

        return response()->json([
            'message' => 'Cliente cadastrado com sucesso',
            'cliente' => $cliente
        ], 201);

        //return redirect('/clientes');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

        return response()->json([ 'cliente' => $cliente ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::find($id);

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

        $cliente = Cliente::updateOrCreate(
            ['id' => $id],
            [
             'nome'  => $request->nome,
             'cpf'   => $request->cpf,
             'email' => $request->email,
            ]
        );

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
        $cliente = Cliente::find($id);

        if (!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

        $cliente->delete();

        $clientes = Cliente::get();

        return response()->json([
            'message' => 'Cliente excluído com sucesso',
            'clientes' => $clientes
        ]);
    }
}
