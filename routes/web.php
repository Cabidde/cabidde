<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LojasController;
use App\Http\Controllers\ProdutosController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\PedidosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/lojas/{idCidade}', [LojasController::class, 'lojasList'])->name('lojas.lista');

Route::get('/cidadeset/{cidadeId?}', [IndexController::class, 'setCidade'])->name('set.cidade');
Route::get('/produtos', [ProdutosController::class, 'produtosLista'])->name('produtos.lista');
Route::get('/produto/{produtoId}/{corId}', [ProdutosController::class, 'produtoDetalhes'])->name('produtos.detalhes');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('cliente.carrinho')->middleware('auth');
Route::post('/carrinho', [CarrinhoController::class, 'addCarrinho'])->name('cliente.addcarrinho');
Route::post('/carrinho/clean', [CarrinhoController::class, 'limparEAdicionarAoCarrinho'])->name('cliente.limpaAdiconaCarrinho');//->middleware('verificarCarrinho');
Route::post('/remover', [CarrinhoController::class, 'removeCarrinho'])->name('cliente.removecarrinho');
Route::post('/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('cliente.atualizacarrinho');
Route::get('/limpar', [CarrinhoController::class, 'limparCarrinho'])->name('cliente.limparcarrinho');
Route::get('/modal/{id}/{quantidade}', [CarrinhoController::class, 'mostrarModal'])->name('cliente.modal');

Route::get('/checkout/process', [MercadoPagoController::class, 'approved'])->name('process.checkout');

Route::get('/pedidos', [PedidosController::class, 'pedidosList'])->name('cliente.pedido')->middleware('auth');
Route::get('/pedidodetail/{pedidoId}', [PedidosController::class, 'pedidodetail'])->name('cliente.pedidoDetail')->middleware('auth');
