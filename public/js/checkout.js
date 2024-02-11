document.getElementById('checkoutButton').addEventListener('click', function() {
    // JSON com os dados do checkout
    console.log('Botão clicado');
    var jsonData = {
        "customer": {
            "address": {
                "country": "55",
                "state": "16",
                "city": "Franca",
                "zip_code": "14402336",
                "line_1": "2281, Rua Francisco Migliorza, Jardim Palestina",
                "line_2": "Complemento"
            },
            "name": "Tony Stark",
            "type": "1",
            "document": "22",
            "email": "Tony@Avangers.com",
            "code": "2",
            "document_type": "CPF",
            "gender": "male"
        },
        "shipping": {
            "address": {
                "country": "55",
                "state": "66",
                "city": "Franca",
                "zip_code": "14402336",
                "line_1": "2281, Rua Francisco Migliorza, Jardim Palestina",
                "line_2": "Complemento"
            }
        },
        "items": [
            {
                "amount": 1,
                "description": "teste",
                "quantity": 1,
                "code": "12"
            }
        ],
        "customer_id": "13",
        "payments":[
            {
                "payment_method":"checkout",
                "amount":2000,
                "checkout": {
                    "customer_editable" : false,
                    "skip_checkout_success_page": true,
                    "accepted_payment_methods": [ "credit_card", "boleto", "pix", "bank_transfer", "voucher","debit_card"],
                    "accepted_multi_payment_methods": [
                        ["credit_card","credit_card"],
                        ["credit_card","boleto"]
                    ],
                    "success_url": "https://www.pagar.me",
                    "bank_transfer": {
                        "bank": ["237", "001", "341"]
                    },
                    "boleto": {
                        "bank": "033",
                        "instructions": "Pagar até o vencimento",
                        "due_at": "2020-07-25T00:00:00Z"
                    },
                    "credit_card": {
                        "capture": true,
                        "statement_descriptor": "Desc na fatura",
                        "installments": [
                            {
                                "number": 1,
                                "total": 10
                            },
                            {
                                "number": 2,
                                "total": 10
                            }
                        ]
                    },
                    "pix": {
                        "expires_in": 100000
                    },
                    "voucher":{
                        "capture": true,
                        "statement_descriptor": "pagar.me"
                    },
                    "debit_card": {
                        "authentication":{
                            "statement_descriptor": "Desc na fatura",
                            "type":"threed_secure",
                            "threed_secure":{
                                "mpi":"acquirer",
                                "success_url":"http://www.pagar.me"
                            }
                        }
                    }
                }
            }
        ]
    };

   // Fazer a requisição
   fetch('https://api.pagar.me/core/v5/orders', {
    method: 'POST',
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(jsonData)
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(data => {
    // Extrair o URL de pagamento da resposta
    var paymentUrl = data.checkouts[0].payment_url;

    // Redirecionar o usuário para o URL de pagamento
    window.location.href = paymentUrl;
})
.catch(error => {
    console.error('There was an error!', error);
});
});
