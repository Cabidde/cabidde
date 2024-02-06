<?php

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Resources\Preference;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Preference\Item;

function clienteConfig(){
    MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_CLIENT_SECRET'));
        $client = new PreferenceClient();
        $itens = \Cart::getContent();
        if(count($itens) == 0){
            return null;
        }

        $cliente = Auth()->user();
        $empresa = $itens->first()->attributes->empresa_id;
           
        $preferenceClient = $client->create([
            "items"=> array(
                array(
                "id" => 'EmpresaID',
                "title" => 'Total do carrinho',
                "quantity" => 1,
                "currency_id" => "BRL",
                "unit_price" => \Cart::getTotal()
                )
            ),

            "back_urls" => array(
                'success' => route('process.checkout'),
                'pending' => 'http://example.com/pending.php',
                'failure' => 'http://example.com/pending.php'
            ),

            "auto_return" => "all",

            /*"payer" => array(
                "name" => $cliente->name,
                "email" => $cliente->email,
                "phone" => array(
                    "area_code" => $cliente->ddd,
                    "number" => $cliente->phone
                )
            ),
            "identification" => array(
                "type" => "CPF",
                "number" => $cliente->cpf
            ),
            "address" => array(
                "street_name" => $cliente->rua,
                "street_number" => $cliente->numeroEndereco,
                "zip_code" => $cliente->cep
            ),
            "statement_descriptor" => "empresaID",
*/
            
        ]);

                
    return $preferenceClient;
}
