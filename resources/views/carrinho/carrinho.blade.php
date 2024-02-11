@extends('layouts.model')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <section class="h-100 gradient-custom">
        <div class="container py-5">
            @if ($itens)
                <div class="row d-flex justify-content-center my-4">
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-header py-3">
                                <h5 class="mb-0">Meu Carrinho</h5>
                            </div>
                            <div class="card-body">
                                @foreach ($itens as $item)
                                    <!-- Single item -->
                                    <div class="row">
                                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                            <!-- Image -->
                                            <div class="bg-image hover-overlay hover-zoom ripple rounded"
                                                data-mdb-ripple-color="light">
                                                <img src="{{ asset('img/produtos/' . $item->attributes->capa) }}"
                                                    class="w-100" alt="Blue Jeans Jacket" />
                                                <a href="#!">
                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)">
                                                    </div>
                                                </a>
                                            </div>
                                            <!-- Image -->
                                        </div>

                                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                            <!-- Data -->
                                            <p><strong>{{ $item->name }}</strong></p>
                                            <p>{{ $item->attributes->corNome }}</p>
                                            <p>Tamanho {{ $item->attributes->variacao }}</p>

                                            <form action="{{ route('cliente.removecarrinho') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <button class="btn btn-primary btn-sm me-1 mb-2"><i
                                                        class="fa-solid fa-trash fa-shake"></i></button>
                                            </form>

                                            {{-- <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip"
                    title="Move to the wish list">
                    <i class="fas fa-heart"></i>
                  </button> --}}

                                        </div>

                                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                            <!-- Quantity -->
                                            <div class="d-flex mb-4" style="max-width: 100px">

                                                <form id="carrinhoForm" action="{{ route('cliente.atualizacarrinho') }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-outline">
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <input class="form-control" min="1" style="width: 100px"
                                                            type="number" name="quantity" value="{{ $item->quantity }}"
                                                            onchange="atualizarCarrinho(this)">
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
                                        <span><strong>R${{ number_format(\Cart::getTotal(), 2, ',', '.') }}</strong></span>
                                    </li>
                                </ul>
                                <!DOCTYPE html>
                                <html lang="en">

                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Formulário de Pagamento</title>
                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            background-color: #f4f4f4;
                                            padding: 20px;
                                        }

                                        .checkout-container {
                                            max-width: 400px;
                                            margin: 0 auto;
                                            background-color: #fff;
                                            padding: 20px;
                                            border-radius: 5px;
                                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        }

                                        .checkout-title {
                                            margin-bottom: 20px;
                                            text-align: center;
                                        }

                                        .form-group {
                                            margin-bottom: 20px;
                                        }

                                        label {
                                            display: block;
                                            font-weight: bold;
                                            margin-bottom: 5px;
                                        }

                                        input[type="text"] {
                                            width: 100%;
                                            padding: 10px;
                                            border: 1px solid #ccc;
                                            border-radius: 3px;
                                            box-sizing: border-box;
                                        }

                                        button[type="submit"] {
                                            width: 100%;
                                            padding: 10px;
                                            background-color: #4CAF50;
                                            color: #fff;
                                            border: none;
                                            border-radius: 3px;
                                            cursor: pointer;
                                            transition: background-color 0.3s;
                                        }

                                        button[type="submit"]:hover {
                                            background-color: #45a049;
                                        }
                                    </style>
                                </head>
                                <!DOCTYPE html>
                                <html lang="en">

                                <head>
                                    <meta charset="UTF-8">
                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                    <title>Formulário de Pagamento</title>
                                    <style>
                                        body {
                                            font-family: Arial, sans-serif;
                                            background-color: #f4f4f4;
                                            padding: 20px;
                                        }

                                        .checkout-container {
                                            max-width: 400px;
                                            margin: 0 auto;
                                            background-color: #fff;
                                            padding: 20px;
                                            border-radius: 5px;
                                            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        }

                                        .checkout-title {
                                            margin-bottom: 20px;
                                            text-align: center;
                                        }

                                        .form-group {
                                            margin-bottom: 20px;
                                        }

                                        label {
                                            display: block;
                                            font-weight: bold;
                                            margin-bottom: 5px;
                                        }

                                        input[type="text"],
                                        select {
                                            width: 100%;
                                            padding: 10px;
                                            border: 1px solid #ccc;
                                            border-radius: 3px;
                                            box-sizing: border-box;
                                        }

                                        button[type="submit"] {
                                            width: 100%;
                                            padding: 10px;
                                            background-color: #4CAF50;
                                            color: #fff;
                                            border: none;
                                            border-radius: 3px;
                                            cursor: pointer;
                                            transition: background-color 0.3s;
                                        }

                                        button[type="submit"]:hover {
                                            background-color: #45a049;
                                        }

                                        .hide {
                                            display: none;
                                        }
                                    </style>
                                </head>
                                {{-- <body>
    <div class="checkout-container">
        <h1 class="checkout-title">Checkout Pagar.Me</h1>
        <form id="payment-form">
            <div class="form-group">
                <label for="payment_method">Método de Pagamento:</label>
                <select id="payment_method" name="payment_method">
                    <option value="credit_card">Cartão de Crédito</option>
                    <option value="pix">PIX</option>
                    <option value="boleto">Boleto</option>
                </select>
            </div>

            <div id="credit_card_fields" class="form-group">
                <label for="card_number">Número do Cartão:</label>
                <input type="text" id="card_number" placeholder="Número do Cartão" required>

                <label for="card_holder_name">Nome no Cartão:</label>
                <input type="text" id="card_holder_name" placeholder="Nome no Cartão" required>

                <label for="card_expiration_date">Data de Expiração (MM/AA):</label>
                <input type="text" id="card_expiration_date" placeholder="MM/AA" required>

                <label for="card_cvv">CVV:</label>
                <input type="text" id="card_cvv" placeholder="CVV" required>
            </div>

            <div id="pix_fields" class="form-group hide">

            </div>

            <div id="boleto_fields" class="form-group hide">

            </div>

            <button type="submit">Pagar</button>
        </form>
    </div>

    <script>
        document.getElementById('payment_method').addEventListener('change', function() {
            var paymentMethod = this.value;

            // Mostrar campos específicos para o método de pagamento selecionado
            if (paymentMethod === 'pix') {
                document.getElementById('pix_fields').classList.remove('hide');
                document.getElementById('credit_card_fields').classList.add('hide');
                document.getElementById('boleto_fields').classList.add('hide');
            } else if (paymentMethod === 'boleto') {
                document.getElementById('boleto_fields').classList.remove('hide');
                document.getElementById('credit_card_fields').classList.add('hide');
                document.getElementById('pix_fields').classList.add('hide');
            } else {
                document.getElementById('credit_card_fields').classList.remove('hide');
                document.getElementById('pix_fields').classList.add('hide');
                document.getElementById('boleto_fields').classList.add('hide');
            }
        });
    </script>
</body>
</html> --}}

                                <!-- Conteúdo da sua página aqui -->

                                <!-- Botão para redirecionar para a página do checkout -->

                                    <button id="checkoutButton">Ir para o Checkout</button>



                                <a id="wallet_container">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>Nenhum produto encontrado</p>
            @endif
        </div>
    </section>

    <script src="{{ asset('js/carrinho.js') }}"></script>


        <script src="{{ asset('js/checkout.js') }}"></script>


@endsection


