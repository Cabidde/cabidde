<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Empresas;
use App\Models\ImgProdutos;
use App\Models\ItemProduto;
use App\Models\CoresProduto;
use App\Models\Cidades;
use App\Models\ViewProdutos;

class ProdutosController extends Controller
{

    public function produtoslista(Request $request){

        $cidadeId = $request->session()->get('cidade');
        if($cidadeId == null){
            return redirect()->route('index');
        }                 
           
        $produtos = ViewProdutos::where('cidade_id', $cidadeId)->inRandomOrder()->get();                        
        
        return view('produtos.list', compact('produtos'));
    }

    public function produtoDetalhes($produtoId, $corId){
    
        //$empresa = Produtos::findOrFail($id)->empresa_id;
        $fotos = ImgProdutos::where(function ($query) use ($produtoId, $corId) {
            $query->where('produto_id', $produtoId)
                  ->where('cor_id', $corId);
        })->get();

        $itensProduto = ItemProduto::where(function ($query) use ($produtoId, $corId) {
            $query->where('produto_id', $produtoId)
                  ->where('cor_id', $corId);
        })->get();        
       
        $produto = ViewProdutos::where('produto_id', $produtoId)->where('cor_id', $corId)->first();
        $outrasCores = ViewProdutos::where('produto_id', $produtoId)->get();
           
        return view('produtos.detail', compact('produto', 'fotos', 'itensProduto', 'outrasCores'));
    }
}
