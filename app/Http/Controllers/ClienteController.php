<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
