@extends('layouts.model')

@section('content')

<h2>Pedidos</h2>

@if($pedidos->count() == 0)
    <div class="col section-1 section-description wow fadeIn">
        <p class="msg">Nenhum pedido Encontrado</p>
        <a class="btn btn-sm" href="#" onclick="voltarParaCidade()">Ir as compras</a>
    </div>
@else
<table class="table table-bordered table-striped">
    <thead>
        <tr>                
            <th>ID</th>
            <th>Status</th>
            <th>Empresa</th>
            <th>Preço</th>
            <th>Data</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pedidos as $pedido)
            <tr>
                <td>{{ $pedido->id }}</td>
                <td>{{ $pedido->status }}</td>
                <td>Nome da empresa</td>
                <td>R$ {{ number_format($pedido->preco_total, 2, ',', '.') }}</td>
                <td>{{ $pedido->created_at }}</td>
                <td><a href="{{ route('cliente.pedidoDetail', ['pedidoId' => $pedido->id]) }}">Detalhes</a></td>

                
                {{-- BTN ATUALIZAR --}}           
                                                                  
            </tr>
        @endforeach
    </tbody>
</table>

@endif

@endsection