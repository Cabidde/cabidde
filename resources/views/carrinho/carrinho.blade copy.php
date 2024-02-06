@extends('layouts.model')

@section('content')

<div class="container">
    <div class="section-2-container section-container" id="section-1">

        @if($mensagem = Session::get('sucesso'))
            <p class="msg">{{ $mensagem }}</p>
        @endif

        @if($itens->count() == 0)
            <div class="col section-1 section-description wow fadeIn">
                <p class="msg">Seu carrinho está Vazio!</p>
                <a class="btn btn-sm" href="#" onclick="voltarParaCidade()">Voltar</a>
            </div>
        @else
            <div class="col section-1 section-description wow fadeIn">        
                <h3>Meu carrinho</h3>
            </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>                
                    <th>Produto</th>
                    <th>Preço un.</th>
                    <th>Qnt.</th>
                    <th>Opções</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itens as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>R$ {{ number_format($item->price, 2, ',', '.') }}</td>
                        
                        {{-- BTN ATUALIZAR --}}
                        
                        <td>
                            <form action="{{ route('cliente.atualizacarrinho') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <input min="1" style="width: 30px" type="number" name="quantity" value="{{ $item->quantity }}"></td>
                                <td>
                                <button class="btn"><i class="fa-solid fa-pen fa-shake"></i></button>
                            </form>
                                    
                        {{-- BTN DELETAR --}}
                        
                        <form action="{{ route('cliente.removecarrinho') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button class="btn"><i class="fa-solid fa-trash fa-shake"></i></button>
                        </form>                        
                    </td>                                                           
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5>Valor Total: R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }}</h5>
        <a class="btn" href="/produtos/{{ $itens->first()->attributes->empresa_id }}">Continuar comprando</a>
        <a class="btn" href="{{ route('cliente.limparcarrinho') }}">Limpar carrinho</a>

        <div id="wallet_container"></div>
    </div> 
</div>


{{-- Botao Mercado Pago --}}
<script src="https://sdk.mercadopago.com/js/v2"></script>


<script>
   
    const mp = new MercadoPago('TEST-499bcf38-196a-4925-b627-7d9fb914c0ae');
    const bricksBuilder = mp.bricks();
  
    mp.bricks().create("wallet", "wallet_container", {
        initialization: {
            preferenceId: "{{ $preferencecliente->id }}",
            redirectMode: "modal",
            
        },
});

</script>
@endif

@endsection
