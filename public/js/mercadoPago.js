

const mp = new MercadoPago('TEST-499bcf38-196a-4925-b627-7d9fb914c0ae');
const bricksBuilder = mp.bricks();

mp.bricks().create("wallet", "wallet_container", {
    initialization: {
        preferenceId: "{{ $preferencecliente->id }}",
        redirectMode: "modal",
        
    },
});