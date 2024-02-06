<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidades;

class IndexController extends Controller
{
    public function index(){        

        $cidades = Cidades::all();
        
        return view('pages.index', compact('cidades'));
    }

    public function setCidade(Request $request, $cidadeId){

        $request->session()->put('cidade', $cidadeId);

        return redirect()->route('produtos.lista');
    }

}
