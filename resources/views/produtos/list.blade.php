@extends('layouts.model')

@section('content')
 <!-- Header-->

 <header class="container d-flex align-items-center justify-content-center h-100"> 
  <div id="slider-capa" class="carousel slide slider-container-capa" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#slider-capa" data-slide-to="0" class="active"></li>
        <li data-target="#slider-capa" data-slide-to="1"></li>
        <li data-target="#slider-capa" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner slider-capa">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('img/carrosel/2.jpg') }}" alt="First slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/carrosel/1.jpg') }}" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('img/carrosel/3.jpg') }}" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#slider-capa" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next" href="#slider-capa" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
  </div>

  <div class="stories">
    
  </div>
</header>

<section>
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">   
            @if(count($produtos) > 0)   
                       
            @foreach($produtos as $produto)
                <div class="col">
                    <div class="card" style="height: 450px ; margin-top: 50px" >
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->

                        <div class="container overflow-hidden img-produto-lista">
                            <img class="mw-100" src="{{ asset('img/produtos/' . $produto->capa)}}" alt="...">
                        </div>                      


                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder capitalize">{{ $produto->produto_nome . " " . $produto->cor_nome}}</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price
                                <span class="text-muted text-decoration-line-through">$20.00</span>-->
                                <span class="text-muted">A partir de R$</span>
                                {{ str_replace('.', ',', $produto->preco) }}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="{{ route('produtos.detalhes', ['produtoId' => $produto->produto_id, 'corId' => $produto->cor_id] ) }}">

                                 Detalhes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <p>Nenhum produto encontrado</p>
                @endif
        </div>
    </div>
</section>


@endsection
