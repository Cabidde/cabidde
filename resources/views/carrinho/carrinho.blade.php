@extends('layouts.model')

@section('content')

<link rel="stylesheet" href="{{ asset('css/carrinho.css')}}">
<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<section class="h-100 gradient-custom">
    <div class="container py-5">
      @if($itens)
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Meu Carrinho</h5>
            </div>
            <div class="card-body">
            @foreach($itens as $item)
              <!-- Single item -->
              <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <!-- Image -->
                  <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="{{ asset('img/produtos/' . $item->attributes->capa)}}"
                      class="w-100" alt="Blue Jeans Jacket" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  <!-- Image -->
                </div>
  
                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                  <!-- Data -->
                  <p><strong>{{ $item->name}}</strong></p>
                  <p>{{ $item->attributes->corNome }}</p>
                  <p>Tamanho {{ $item->attributes->variacao }}</p>

                  <form action="{{ route('cliente.removecarrinho') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button class="btn btn-primary btn-sm me-1 mb-2" ><i class="fa-solid fa-trash fa-shake"></i></button>
                </form> 
                  
                  {{--<button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                    title="Move to the wish list">
                    <i class="fas fa-heart"></i>
                  </button>--}}
                 
                </div>
  
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <!-- Quantity -->
                  <div class="d-flex mb-4" style="max-width: 100px">

                    <form id="carrinhoForm" action="{{ route('cliente.atualizacarrinho') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="form-outline">
                      <input type="hidden" name="id" value="{{ $item->id }}">
                      <input  class="form-control" min="1" style="width: 100px" type="number" name="quantity" value="{{ $item->quantity }}" onchange="atualizarCarrinho(this)">
                      </div>
                    </form>                   
                                 
                                     </div>                 
  
                  <!-- Price -->
                  <p class="text-start text-md-center">
                    <strong>R$ {{ number_format($item->price, 2, ',', '.') }}</strong>
                  </p>
                 
                </div>
              </div>
              <!-- Single item -->
  
              <hr class="my-4" />  
              @endforeach
            </div>
          </div>
          <div class="card mb-4">
            <div class="card-body">
              <p><strong>Entrega Hoje comprando em até 2 Horas</strong></p>
              <p class="mb-0"></p>
              <a class="btn" href="{{ route('produtos.lista') }}">Continuar comprando</a>
              <a class="btn" href="{{ route('cliente.limparcarrinho') }}">Limpar carrinho</a>
            </div>
          </div>          
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Resumo</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Produtos
                  <span>R$ {{ number_format(\Cart::getTotal(), 2, ',', '.') }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Entrega
                  <span>Gratis</span>
                </li>
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                  <div>
                    <strong>Total</strong>                   
                  </div>
                  <span><strong>R${{ number_format(\Cart::getTotal(), 2, ',', '.')}}</strong></span>
                </li>
              </ul>
  
              <a id="wallet_container">                
              </a>
            </div>
          </div>
        </div>
      </div>
       {{-- Botao Mercado Pago --}}
      <script src="https://sdk.mercadopago.com/js/v2"></script>
      <script src="{{ asset('js/mercadoPago.js')}}"></script>
      @else
      <p>Nenhum produto encontrado</p>
      @endif
    </div>
  </section>

  <script src="{{ asset('js/carrinho.js')}}"></script>

@endsection
