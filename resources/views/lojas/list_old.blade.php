@extends('layouts.model')

@section('content')

{{-- Modal de selecionar cidades --}}
<div class="modal" id="meuModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Escolha sua Cidade</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                @foreach ($cidades as $cidade)
                                   
                    <a href="{{ route('lojas.lista', ['idCidade' => $cidade->id]) }}" class="btn">
                        {{ $cidade->nome }}
                    </a>
                                                           
                @endforeach
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<!-- Section 1 -->
<div class="section-2-container section-container" id="section-1">
    <div class="container">
            <div class="col section-1 section-description wow fadeIn">			                    
                <h2><strong>Restaurantes em {{ $cidadeSelect }}</strong></h2>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#meuModal">
                    Alterar Cidade
                </button>	                						
                <div class="divider-1 wow fadeInUp"><span></span></div>
            </div>
        </div>        
    </div>
</div>

{{-- Restaurantes --}}
<div class="section-2-container section-container section-container-gray-bg" id="section-1">
    <div class="col-md-8 mx-auto text-center">          
        @foreach($empresas as $empresa)
        <div class="row">
            <div class="col-8 section-2-box wow fadeInLeft">
                <a href="/produtos/{{ $empresa->id }}">
                    <h3><strong>{{ $empresa->fantasia }}</strong></h3>
                    <p class="medium-paragraph">
                        {{ $empresa->descricao }}
                    </p>
                </a>
            </div>
           
            <div class="col-4 section-2-box wow fadeInUp">
                <a href="/produtos/{{ $empresa->id }}">
                <img src="{{ asset('img/about-us.jpg') }}" alt="about-us">
            </a>
            </div>
        
        </div>
        <hr>
        @endforeach
    </div>
</div>

<!-- Section 2 -->
<div class="section-2-container section-container section-container-gray-bg" id="section-2">
    <div class="container">
        <div class="row">
            <div class="col section-2 section-description wow fadeIn">
                <p>Como Funciona</p>
            </div>
        </div>
        <div class="row">
            <div class="col-8 section-2-box wow fadeInLeft">
                <h3>Tchau Panela</h3>
                <p class="medium-paragraph">
                    Comer em Franca Ficou muito mais Gostoso! O Tchau Panela nao cobra comissão dos restaurantes, por isso é bem mais barato do que outros aplicativos de delivery, alem de voce poder usufruir de diversos cupons de desconto para usar tanto dentro do restaurante, como por Delivery!
                </p>

            </div>
            <div class="col-4 section-2-box wow fadeInUp">
                <img src="{{ asset('img/about-us.jpg') }}" alt="about-us">
            </div>
        </div>
    </div>
</div>

<!-- Section 4 -->
<div class="section-4-container section-container section-container-image-bg" id="section-4">
    <div class="container">
        <div class="row">
            <div class="col section-4 section-description wow fadeInLeftBig">
                <h2>Não encontrou seu restaurante Favorito?</h2>
                <p>
                    Não se preocupe! é só clicar no link a baixo para nosso time entrar em contato com o restaurante!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col section-bottom-button wow fadeInUp">
                <a class="btn btn-primary btn-customized-2 scroll-link" href="#section-6" role="button">
                    <i class="fas fa-envelope"></i> Enviar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Section 6 -->
<div class="section-6-container section-container" id="section-6">
    <div class="container">
        <div class="row">
            <div class="col section-6 section-description wow fadeIn">
                <h2>Tem um restaurante?</h2>
            </div>
          </div>
        <div class="row">
            <div class="col-md-6 section-6-box wow fadeInUp">
                <h3>Preencha suas informações</h3>
                <div class="section-6-form">
                    <form role="form" action="{{ asset('contact.php') }}" method="post">
                        <div class="form-group">
                            <label class="sr-only" for="contact-email">Email</label>
                            <input type="text" name="email" placeholder="Seu melhor E-mail" class="contact-email form-control" id="contact-email">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="contact-subject">Subject</label>
                            <input type="text" name="subject" placeholder="Nome do estabelecimento" class="contact-subject form-control" id="contact-subject">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="contact-message">Message</label>
                            <textarea name="message" placeholder="WhatsApp" class="contact-message form-control" id="contact-message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-customized"><i class="fas fa-paper-plane"></i>Solicitar Contato</button>
                    </form>
                </div>
            </div>
            <div class="col-md-5 offset-md-1 section-6-box wow fadeInDown">
                <h3>Acompanhe nossas redes sociais!</h3>
                <div class="section-6-social">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
