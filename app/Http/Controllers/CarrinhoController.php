<?php

namespace App\Http\Controllers;
//include base_path('\app\Services\mercadoPagoService.php');
use Illuminate\Http\Request;
use App\Models\Produtos;

//use App\Services\mercadoPagoService;


class CarrinhoController extends Controller
{
    public function carrinhoLista(){

        $itens = \Cart::getContent();
        //$preferencecliente = clienteConfig();

        return view('carrinho.carrinho', compact('itens'));
    }

    public function addcarrinho(Request $request){

        \Cart::add([
            'id' => $request->prodId . "-" . $request->corId . "-" . $request->gradeId . "-" . $request->variacao,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->qnt,
            'attributes' => array(
                'prodId' => $request->prodId,
                'corId' => $request->corId,
                'corNome' => $request->corNome,
                'gradeId' =>$request->gradeId,
                'variacao' => $request->variacao,
                'capa' => $request->capa,
                'empresa_id' => $request->empresa_id,
            )
        ]);

        return redirect()->route('cliente.carrinho');
    }

    public function limparEAdicionarAoCarrinho(Request $request){

        \Cart::clear();

        \Cart::add([
            'id' => $request->prodId . "-" . $request->corId . "-" . $request->gradeId . "-" . $request->variacao,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->qnt,
            'attributes' => array(
                'prodId' => $request->prodId,
                'corId' => $request->corId,
                'corNome' => $request->corNome,
                'gradeId' =>$request->gradeId,
                'variacao' => $request->variacao,
                'capa' => $request->capa,
                'empresa_id' => $request->empresa_id,
            )
        ]);

        return redirect()->route('cliente.carrinho');
    }

    public function mostrarModal(Request $request){
       return view('produtos.modal', compact('request'));
    }

    public function removeCarrinho(Request $request){
        \Cart::remove($request->id);

        return redirect()->route('cliente.carrinho');
    }

    public function limparCarrinho(Request $request){
        \Cart::clear();

        return redirect()->route('produtos.lista');
    }

    public function mostrarCheckout(Request $request){
        return view('checkout');
    }


    public function atualizaCarrinho(Request $request){
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => $request->quantity
            ]
        ]);

        return redirect()->route('cliente.carrinho');
    }


}
