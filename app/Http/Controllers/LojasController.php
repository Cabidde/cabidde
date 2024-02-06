<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cidades;
use App\Models\Empresas;

class LojasController extends Controller
{
    public function lojasList($idCidade){

        setcookie('cidade', $idCidade, time() + 3600, '/');

        $cidades = Cidades::all();               
        $cidadeSelect = Cidades::findOrFail($idCidade)->nome;
        $empresas = Empresas::where('cidade_id', $idCidade)->paginate(12);     

        return view('lojas.list', compact('empresas', 'cidadeSelect', 'cidades'));
    }
    
}
