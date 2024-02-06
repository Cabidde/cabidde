
$(document).ready(function(){   
    
    $('#slidçer-capa').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: false
    });

    $('.slider').slick({
        dots: true,
        infinite: true,
        speed: 500,
        slidesToShow: 1,
        adaptiveHeight: true
    });

    $('.variacao-btn').on('click', function () {
        // Remove a classe ativa de todos os botões
        $('.variacao-btn').removeClass('active');
        
        // Adiciona a classe ativa ao botão clicado
        $(this).addClass('active');
    });


    $('input[name="variacao"]').on('change', function () {
        var preco = $(this).attr('id');
        $('.preco-dinamico').text('R$ ' + preco.replace('.', ','));
        $('input[name="price"]').val(preco);
    });


    $('button[name="add-to-cart"]').on('click', function () {
        // Verificar se pelo menos uma opção de tamanho foi escolhida
        if ($('input[name="variacao"]:checked').length === 0) {
            alert('Selecione um tamanho antes de adicionar ao carrinho.');
            return false; 
        }
       
    });
});