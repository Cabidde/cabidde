@extends('layouts.model')

@section('content')

<section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-10 col-xl-8">          
          <div class="card-header px-4 py-5">
            <h5 class="text-muted mb-0">Acompanhe seus Pedidos, <span style="color: #787577;">{{ Auth()->user()->name }}</span>!</h5>
          </div>
            @foreach($pedidos as $pedido)
              <div class="card" style="border-radius: 10px;">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center mb-4">
                    <p class="lead fw-normal mb-0" style="color: #7d7c7d;">{{ $pedido->etapa }}</p>
                    <p class="small text-muted mb-0">ID Pedido : {{ $pedido->id }}</p>
                  </div>
                  @foreach($pedido->itenspedido as $item)
                  <div class="card shadow-1 border mb-4">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-2">
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/13.webp"
                            class="img-fluid" alt="Phone">
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0">{{ $item->produto }}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small">{{ $item->cor }}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small">Tam {{ $item->variacao }}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small">Qnt {{ $item->quantidade }}</p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small">R$ {{ number_format($item->preco_unitario, 2, ",", ".") }}</p>
                        </div>
                      </div>
                      <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                      
                    </div>
                  </div>
                  @endforeach

                  <div class="row d-flex align-items-center">
                    <div class="col-md-2">
                      <p class="text-muted mb-0 small">Status do pedido</p>
                    </div>
                    <div class="col-md-10">
                      <div class="progress" style="height: 6px; border-radius: 16px;">
                        <div class="progress-bar" role="progressbar"
                          style="width: 30%; border-radius: 16px; background-color: #252525;" aria-valuenow="30"
                          aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <div class="d-flex justify-content-around mb-1">
                        <p class="text-muted mt-1 mb-0 small ms-xl-5">{{ $pedido->etapa }}</p>                    
                      </div>
                    </div>
                  </div>
                  
      
                  <div class="d-flex justify-content-between pt-2">
                    <p class="fw-bold mb-0">Detalhes do Pagamento</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Total</span>{{ number_format($pedido->preco_total, 2, ",", ".") }}</p>
                  </div>
      
                  <div class="d-flex justify-content-between pt-2">
                    <p class="text-muted mb-0">ID Pagamento : 788152</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Cupom</span> $19.00</p>
                  </div>
      
                  <div class="d-flex justify-content-between">
                    <p class="text-muted mb-0">{{ $pedido->created_at }}</p>                
                  </div>
      
                  <div class="d-flex justify-content-between mb-5">                
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Vendido por </span>{{ $pedido->empresa_nome }}</p>
                    <p class="text-muted mb-0"><span class="fw-bold me-4">Entrega</span>0</p>
                  </div>
                </div>
                <div class="card-footer border-0 px-4 py-5"
                  style="background-color: #363636; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                  <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
                    pago <span class="h2 mb-0 ms-2"></span>R$ {{ number_format($pedido->preco_total, 2, ",", ".") }}</h5>
                </div>                                
              </div>
              <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
              <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
            @endforeach
        </div>
      </div>
    </div>
  </section>

  @endsection