@extends('layouts.model')

@section('content')

<a class="btn" href="{{ route('cliente.pedido') }}">voltar</a>

<h2>Detalhes do Pedido</h2>

<table class="table table-bordered table-striped">
    <thead>
        <tr>   
            <th>.</th>             
            <th>Produto</th>
            <th>Preço Un.</th>
            <th>Quantidade</th>
            <th>Sub-Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itensPedido as $item)
            <tr>
                <td><img src="/img/products/WhatsApp Image 2023-11-10 at 16.24.01.jpeg" class="img-pedido" alt="img-prod"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->preco_unitario }}</td>
                <td>{{ $item->quantidade }}</td>                
                <td>R$ {{ number_format(($item->quantidade * $item->preco_unitario), 2, ',', '.') }}</td>           
                                                                  
            </tr>
        @endforeach
    </tbody>
</table>

@endsection