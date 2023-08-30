<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|unique:produtos',
            'descricao' => 'required',
            'valor'     => 'required|numeric',
        ]);

        $produto = new Produto([
            'nome'            => $request->nome,
            'descricao'       => $request->descricao,
            'valor'           => $request->valor,
            'tipo_produto_id' => $request->tipo_produto_id,
            'disponivel'      => $request->disponivel ?? true,
        ]);

        $produto->save();

        return response()->json([
            'message' => 'Produto criado com sucesso',
            'produto' => $produto
        ], 201);

        //return redirect('/produtos');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $produto = Produto::find($id);

        if(!$produto)
            return response()->json(['message' => 'Produto não encontrado'], 404);

        return response()->json([ 'produto' => $produto ]);
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
