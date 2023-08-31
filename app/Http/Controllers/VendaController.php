<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Produto;
use App\Models\Venda;
use App\Models\VendaItem;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendas = Venda::with('cliente', 'items.produto')->get()->makeHidden(['created_at', 'updated_at']);

        return response()->json(['vendas' => $vendas]);
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
        $validator = Validator::make($request->all(), [
            'cliente.nome'      => 'required',
            'cliente.cpf'       => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' =>  $validator->errors()]);
        }

        $dados = $request->all();
        $cliente = Cliente::find($dados['cliente']['id']);

        if (!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

        if (isset($dados['itens']) && count($dados['itens']) > 0) {
            try {
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

                return response()->json(
                    [   'message'      => 'Venda realizada com sucesso !',
                        'venda'        => $venda->makeHidden('created_at', 'updated_at'),
                        'cliente'      => $cliente->makeHidden('primeira_compra','created_at', 'updated_at'),
                        'itens'        => $itens->makeHidden('created_at', 'updated_at'),
                        'sem_cadastro' => $produtoNaoEncontrado
                    ]);

            } catch (Exception $exception) {
                $erro = $exception->getMessage();
                return response()->json(['message' => $erro], 500);
            }
        }

        return response()->json(['message' => 'Nenhum produto informado para venda'], 404);
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
