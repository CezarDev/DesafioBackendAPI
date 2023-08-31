<?php

namespace App\Services;

use App\Models\Produto;

class ProdutoService
{
    public function salvarProduto($request)
    {
        $produto = new Produto([
            'nome'            => $request->nome,
            'descricao'       => $request->descricao,
            'valor'           => $request->valor,
            'link'            => $request->link ?? null,
            'tipo_produto_id' => $request->tipo_produto_id,
            'disponivel'      => $request->disponivel ?? true,
        ]);

         $produto->save();

         return $produto;
    }

    public function atualizarProduto($request, $id)
    {
        return Produto::updateOrCreate(
            ['id' => $id],
            [
                'nome'            => $request->nome,
                'descricao'       => $request->descricao,
                'valor'           => $request->valor,
                'link'            => $request->link ?? null,
                'tipo_produto_id' => $request->tipo_produto_id,
            ]);
    }

    public function excluirProduto($produto)
    {
        $produto->delete();

        return Produto::get();
    }

    public function buscarProdutoPeloId($id)
    {
        return Produto::find($id);
    }
}
