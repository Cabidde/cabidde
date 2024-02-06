<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ItemPedido;

class PedidosController extends Controller
{

    public function pedidosList() {

        $clienteId = Auth()->user()->id;

        $pedidos = Pedido::with('itensPedido')
        ->where('cliente_id', $clienteId)
        ->orderBy('created_at', 'desc')
        ->get();
        //dd($pedidos);        

        return view('pedidos.list', compact('pedidos'));
    }

    public function pedidoDetail($pedidoId) {

        $itensPedido = ItemPedido::where('pedido_id', $pedidoId)->get();

        return view('pedidos.detail-order', compact('itensPedido'));
    }
   
}
