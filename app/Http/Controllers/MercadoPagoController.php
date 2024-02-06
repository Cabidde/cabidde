<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ItemPedido;
use App\Models\Repasse;
use App\Models\Empresas;
use App\Models\ItemGrade;


class MercadoPagoController extends Controller{

    public function approved(Request $request) {

        $precoTotal = \Cart::getTotal();
        $data = new \DateTime();
        $produtosInfo = \Cart::getContent();
        $empresaId = \Cart::getContent()->first()->attributes->empresa_id;
        $paymentID = $request->payment_id;
        $status = $request->status;
            
        $pedidoId = $this->addPedido($precoTotal, $empresaId, $status);
        $this->addItemPedido($pedidoId, $produtosInfo,);
        $this->addRepasse($empresaId, $pedidoId, $precoTotal, $data);

        \Cart::clear();

        return redirect()->route('cliente.pedido');
    }

    public function addPedido($precoTotal, $empresaId, $status){        
               
        $empresaNome = Empresas::where('id', $empresaId)->first()->nome;

        $pedido = new Pedido();
        $pedido->cliente_id = Auth()->user()->id;
        $pedido->empresa_id = $empresaId;
        $pedido->empresa_nome = $empresaNome;
        $pedido->preco_total = $precoTotal;
        $pedido->status_pgto = $status;

        $pedido->save();

        return $pedido->id;
    }

    public function addItemPedido($pedidoId, $produtosInfo){

        foreach($produtosInfo as $produto){                                 

            $itemPedido = new ItemPedido();
            $itemPedido->thumb = 'caminho';
            $itemPedido->cliente_id = Auth()->user()->id;
            $itemPedido->pedido_id = $pedidoId;
            $itemPedido->produto = $produto->name;
            $itemPedido->produto_id = $produto->attributes->prodId;
            $itemPedido->cor_id = $produto->attributes->corId;
            $itemPedido->cor = $produto->attributes->corNome;
            $itemPedido->grade_id = $produto->attributes->gradeId;
            $itemPedido->variacao = $produto->attributes->variacao;
            $itemPedido->quantidade = $produto->quantity;
            $itemPedido->preco_unitario = $produto->price;

            $itemPedido->save();
        }      
      
    }

    public function addRepasse($empresaId, $pedidoId, $precoTotal, $data){

        $repasse = new Repasse();
        $repasse->empresa_id = $empresaId;
        $repasse->pedido_id = $pedidoId;
        $repasse->id_pagamento = 12345;
        $repasse->forma_pagto = 1;
        $repasse->taxa_pgto = 3;
        $repasse->valor_bruto = $precoTotal;
        $repasse->comissao = 10;
        $repasse->valor_liquido = ($precoTotal - ($precoTotal / 100 * 10) - ($precoTotal / 100 * 3));
        $repasse->status_pgto = 'pendente';
        $repasse->previsao_pgto = $data->modify('+8 days');
        
        $repasse->save();
    }
}
