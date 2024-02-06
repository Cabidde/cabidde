function atualizarCarrinho(input) {
    // Obtenha o formulário pai do campo de entrada
    var form = input.form;

    setTimeout(function() {
        // Envie o formulário automaticamente após o atraso
        form.submit();
    }, 1000);
}