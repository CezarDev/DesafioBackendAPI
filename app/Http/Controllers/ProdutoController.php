<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoRequest;
use App\Models\Produto;
use App\Services\ProdutoService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdutoController extends Controller
{
    protected ProdutoService $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }

    public function index()
    {
        $produtos = Produto::get();

        return response()->json(['produtos' => $produtos]);
    }


    public function store(ProdutoRequest $request)
    {
        try {
            $produto = $this->produtoService->salvarProduto($request);

        } catch (Exception $exception) {

            $erro = $exception->getMessage();
            return response()->json(['message' => $erro], 500);
        }

        return response()->json([
            'message' => 'Produto criado com sucesso',
            'produto' => $produto
        ], 201);
    }


    public function show(string $id)
    {
        $produto = Produto::find($id);

        if(!$produto)
            return response()->json(['message' => 'Produto não encontrado'], 404);

        return response()->json([ 'produto' => $produto ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome'      => 'required|',
            'descricao' => 'required',
            'valor'     => 'required|numeric',
        ]);

        try {
            $produto = $this->produtoService->atualizarProduto($request, $id);

        } catch (Exception $exception) {

            $erro = $exception->getMessage();
            return response()->json(['message' => $erro], 500);
        }

        return response()->json([
            'message' => 'Produto atualizado com sucesso',
            'produto' => $produto
        ]);
    }

    public function destroy(string $id)
    {
        $produto = $this->produtoService->buscarProdutoPeloId($id);

        if (!$produto)
            return response()->json(['message' => 'Produto não encontrado'], 404);

        $produtos = $this->produtoService->excluirProduto($produto);

        return response()->json([
            'message' => 'Produto excluído com sucesso',
            'produtos' => $produtos
        ]);
    }

    public function downloadLink($id)
    {
        $produto = Produto::find($id);

        if (!$produto || empty($produto->link)) {
            return response()->json(['message' => 'Produto não encontrado ou sem link de download'], 404);
        }

        return response()->json(['download_link' => $produto->link]);
    }
}
