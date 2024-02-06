@extends('layouts.model')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<!-- Product section-->
<section class="py-0">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            {{-- Imagem Principal --}}
            <div class="col-md-8">
                <div class="slider-container">
                    <div class="slider">
                        @foreach ($fotos as $foto) 
                                <div class="container overflow-hidden container-img">
                                <img src="{{ asset('img/produtos/' . $foto->caminho) }}" alt="Imagem">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="small mb-1">Vendido por <a class="name-link" href="">{{ $produto->empresa_nome }}</a> </div>
                            <div class="d-flex small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <h1 class="display-5 fw-bolder">{{ $produto->produto_nome . " " . $produto->cor_nome }}</h1>
                            <div class="fs-4 mb-3">
                                {{--<span class="text-decoration-line-through">${{ $variacao->preco_antigo }}</span>--}}
                                <span class="preco-dinamico">R$ {{ str_replace('.', ',', $itensProduto[0]->preco) }}</span>
                            </div>
                        </div>
                        <form action="{{ route('cliente.addcarrinho') }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            {{-- Variações --}}
                            <div class="col-md-12">
                                <p>Tamanhos Disponíveis</p>
                                <div class="row gx-1 gx-lg-1 row-cols-4 row-cols-md-6 row-cols-xl-8 fs-4 mb-3">                    
                                    @foreach ($itensProduto as $itemproduto)
                                        <div class="col mb-1">                           
                                            <!-- Product actions-->
                                            <div class="card-footer pt-0 border-top-0 bg-transparent">                                       
                                                <label class="btn btn-outline-dark mt-auto variacao-btn">
                                                    <input type="radio" name="variacao" id="{{ $itemproduto->preco}}" value="{{ $itemproduto->variacao }}">
                                                    {{ $itemproduto->variacao }}
                                                </label>                                                                               
                                            </div> 
                                        </div>
                                    @endforeach
                                </div> 
                            </div>
                        
                            <input type="hidden" name="empresa_id" value="{{ $produto->empresa_id }}">
                            <input type="hidden" name="name" value="{{ $produto->produto_nome }}">
                            <input type="hidden" name="prodId" value="{{ $produto->produto_id }}">
                            <input type="hidden" name="corId" value="{{ $produto->cor_id }}">
                            <input type="hidden" name="corNome" value="{{ $produto->cor_nome }}">
                            <input type="hidden" name="gradeId" value="{{ $produto->grade_id }}">
                            <input type="hidden" name="capa" value="{{ $produto->capa }}">
                            <input type="hidden" name="price" class="preco-dinamico" value="">      
                            <div class="col-md-12">
                                <div class="d-flex">
                                    <input class="form-control text-center me-3" name="qnt" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                    <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                        <i class="bi-cart-fill me-1"></i>                                       
                                        Adicionar ao carinho
                                    </button>
                                </div>                           
                            </div>
                        </form>

                        {{-- Variações --}}
                        <div class="col-md-12 mt-4">
                            <p>Outras Cores</p>
                            <div class="row gx-1 gx-lg-1 row-cols-4 row-cols-md-6 row-cols-xl-8 fs-4 mb-3">                    
                                @foreach ($outrasCores as $outracor)
                                    <div class="col mb-1">                           
                                        <!-- Product actions-->
                                        <div class="card-footer pt-0 border-top-0 bg-transparent">                                       
                                            <a class="btn btn-outline-dark mt-auto" href="{{ route('produtos.detalhes', ['produtoId' => $outracor->produto_id, 'corId' => $outracor->cor_id] ) }}">
                                                <img src="{{ asset('img/produtos/' . $outracor->capa) }}" alt="">
                                            </a>                                        
                                        </div> 
                                    </div>
                                @endforeach
                            </div> 
                        </div>

                    </div>
                </div>
           
        </div>  
        {{-- descrição --}}
      <p class="lead pt-md-4">{{ $produto->descricao }}</p>            
    </div>
</section>


<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Fancy Product</h5>
                            <!-- Product price-->
                            $40.00 - $80.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Special Item</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">$20.00</span>
                            $18.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Sale Item</h5>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">$50.00</span>
                            $25.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Popular Item</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            $40.00
                        </div>
                    </div>
                    
            </div>
        </div>
    </div>
</section>


@endsection