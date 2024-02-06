@extends('layouts.model')

@section('content')

<div class="modal fade" id="limparCarrinhoModal" tabindex="-1" role="dialog" aria-labelledby="limparCarrinhoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="limparCarrinhoModalLabel">Limpar Carrinho</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{$request}}</p>
                <p>Você tem produtos de outra empresa no carrinho</p>
                <p>Deseja limpar o carrinho e adicionar o item?</p>

                <form action="{{ route('cliente.limpaAdiconaCarrinho') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="empresa_id" value="{{ $produto->empresa_id }}">
                    <input type="hidden" name="name" value="{{ $produto->nome }}">
                    <input type="hidden" name="prodId" value="{{ $produto->id }}">
                    <input type="hidden" name="corId" value="{{ $produto->cor_id }}">
                    <input type="hidden" name="corNome" value="{{ $produto->cor_nome }}">
                    <input type="hidden" name="gradeId" value="{{ $produto->grade_id }}">
                    <input type="hidden" name="capa" value="{{ $produto->capa }}">                    
                    
                    <button type="submit" class="btn orange btn-large">
                        Limpar e Adicionar ao carrinho
                    </button>
                </form>
                
                <a href="{{ route('cliente.carrinho') }}" class="btn btn-secondary">Manter Carrinho</a>
            </div>          
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    // Verifique se há produtos no carrinho e, em seguida, exiba o modal
    $(document).ready(function() {
            
        var haProdutosNoCarrinho = true;

        if (haProdutosNoCarrinho) {
            $('#limparCarrinhoModal').modal('show');
        }
    });
</script>  