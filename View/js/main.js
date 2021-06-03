(function ($) {
    "use strict";
    
    // Dropdown on mouse hover
    $(document).ready(function () {
        function toggleNavbarMethod() {
            if ($(window).width() > 768) {
                $('.navbar .dropdown').on('mouseover', function () {
                    $('.dropdown-toggle', this).trigger('click');
                }).on('mouseout', function () {
                    $('.dropdown-toggle', this).trigger('click').blur();
                });
            } else {
                $('.navbar .dropdown').off('mouseover').off('mouseout');
            }
        }
        toggleNavbarMethod();
        $(window).resize(toggleNavbarMethod);
    });
    
    $('.product-slider-4').slick({
        autoplay: true,
        infinite: true,
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });
    
  
      
    // Widget slider
    $('.sidebar-slider').slick({
        autoplay: true,
        dots: false,
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
    });
    
    
    // Quantidade
    $('.qty button').on('click', function () {
        
        var $button = $(this);
        var oldValue = $button.parent().find('input').val();
        var valorUnitario = parseFloat($button.parent().parent().parent().find('.precoUnitario').text())

        if ($button.hasClass('btn-plus')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find('input').val(newVal);

        var valorTotalItem = valorPelaQuantidade(valorUnitario ,newVal);

        $button.parent().parent().parent().find('.precoTotalItem').text(valorTotalItem.toString());
        
        calculaTotalCarrinho();


    });

    //Função para trazer o valor do item de acordo com a quantidade
    function valorPelaQuantidade(valorUnitario, qtdItens){

        var valorToralItem = valorUnitario * qtdItens;
        var vlrArred = valorToralItem.toFixed(2);
        return vlrArred;      
    }

    //Função para calcular o subtotal
    function calculaTotalCarrinho(){
        debugger
        var subTotais = document.querySelectorAll('.precoTotalItem')
        var precoFrete = parseFloat($('#precoFrete').text());
        var valorSubTotal = 0;

        for(var i = 0; i < subTotais.length ; i++){
            var subParse = parseFloat(subTotais[i].outerText)
            valorSubTotal += subParse;
        }
        var precoTotal = valorSubTotal + precoFrete;
        var totalArred = precoTotal.toFixed(2);
        var totalStr = totalArred.toString();
        var vlrArred = valorSubTotal.toFixed(2);
       

        var vlrStr = vlrArred.toString();
        document.getElementById('valorSubtotal').innerHTML = "R$ " + vlrStr;
        document.getElementById('precoTotalCompra').innerHTML = "R$ " + totalStr.toString();
        
    }

    function removeProduto(item) {
        $(item).closest("tr").innerHTML = "";
    }

    removeProduto();
    
    // Shipping address show hide
    $('.checkout #shipto').change(function () {
        if($(this).is(':checked')) {
            $('.checkout .shipping-address').slideDown();
        } else {
            $('.checkout .shipping-address').slideUp();
        }
    });
    
    
    // Payment methods show hide
    $('.checkout .payment-method .custom-control-input').change(function () {
        if ($(this).prop('checked')) {
            var checkbox_id = $(this).attr('id');
            $('.checkout .payment-method .payment-content').slideUp();
            $('#' + checkbox_id + '-show').slideDown();
        }
    });

    var valorSoma = 0;

    //Soma o valor do produto
    $('.btnCarrinho').on('click', function(){
        var $button = $(this);
        var valorLivro = parseFloat($button.parent().find('.valor').text());
        valorSoma = valorSoma + valorLivro; 

        var valorArredondado = valorSoma.toFixed(2) 
        var valorString = valorArredondado.toString();
        
        console.log(typeof valorSoma)
       
        document.getElementById('cartPrice').innerHTML =  valorString;

    })
})(jQuery);

