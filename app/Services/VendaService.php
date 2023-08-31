<?php

namespace App\Services;

use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaItem;

class VendaService
{
    public function salvarVenda($dados,$cliente)
    {
        $valorTotal = 0;

        $venda = new Venda([
            'descricao' => $dados['descricao'],
            'valor_total' => $valorTotal,
            'data_venda' => date('Y-m-d H:i:s'),
            'cliente_id' => $cliente->id
        ]);
        $venda->save();

        $produtoNaoEncontrado = '';
        foreach ($dados['itens'] as $item) {
            $produto = Produto::find($item['id']);
            if ($produto) {

                $valorTotalItem = ($item['quantidade'] * $produto->valor);

                $intesDaVenda = new VendaItem([
                    'quantidade'     => $item['quantidade'],
                    'valor_unitario' => $produto->valor,
                    'valor_total'    => $valorTotalItem,
                    'venda_id'       => $venda->id,
                    'cliente_id'     => $cliente->id,
                    'produto_id'     => $produto->id,
                ]);

                $intesDaVenda->save();
                $valorTotal += $valorTotalItem;

            } else {
                $produtoNaoEncontrado .= $item['descricao'] . " ";
            }
        }

        $venda = Venda::updateOrCreate(['id' => $venda->id], ['valor_total' => $valorTotal]);

        $itens = VendaItem::where('venda_id', $venda->id)->get();

        return [
            'venda' => $venda,
            'itens' => $itens,
            'produtoNaoEncontrado' => $produtoNaoEncontrado,
        ];
    }
}
