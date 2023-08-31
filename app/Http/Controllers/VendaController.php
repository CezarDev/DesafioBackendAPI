<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaRequest;
use App\Models\Cliente;
use App\Models\Venda;
use App\Services\VendaService;
use Exception;
use Illuminate\Routing\Controller;

class VendaController extends Controller
{
    protected VendaService $vendaService;

    public function __construct(VendaService $vendaService)
    {
        $this->vendaService = $vendaService;
    }

    public function index()
    {
        $vendas = Venda::with('cliente', 'items.produto')->get()->makeHidden(['created_at', 'updated_at']);

        return response()->json(['vendas' => $vendas]);
    }

    public function store(VendaRequest $request)
    {
        $dados = $request->all();
        $cliente = Cliente::find($dados['cliente']['id']);

        if (!$cliente)
            return response()->json(['message' => 'Cliente não encontrado'], 404);

        if (isset($dados['itens']) && count($dados['itens']) > 0)
        {
            try {

             $dadosDaVenda = $this->vendaService->salvarVenda($dados,$cliente);

                return response()->json(
                    [   'message'      => 'Venda realizada com sucesso !',
                        'venda'        => $dadosDaVenda['venda'],
                        'cliente'      => $cliente,
                        'itens'        => $dadosDaVenda['itens'],
                        'sem_cadastro' => $dadosDaVenda['produtoNaoEncontrado']
                    ]);

            } catch (Exception $exception) {
                $erro = $exception->getMessage();

                return response()->json(['message' => $erro], 500);
            }
        }

        return response()->json(['message' => 'Nenhum produto informado para venda'], 404);
    }
}
