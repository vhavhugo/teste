
$('.btn-tipo-cadastro').on('click', function () {
    var tipo = $(this).data('tipo');
    if (tipo == 'pessoa-juridica') {
        $("#pessoa-fisica").hide();
        $("#pessoa-juridica").removeClass('hide').show();
        $("#pessoa-fisica").find('input').val('');
        $("#cliente_tipo").val(2);
    } else {
        $("#pessoa-fisica").removeClass('hide').show();
        $("#pessoa-juridica").hide();
        $("#pessoa-juridica").find('input').val('');
        $("#cliente_tipo").val(1);
    }


    // valida CNPJ
    $('#cliente_cnpj').on('change',function(e){
        valid = true;
        var elm = $('#cliente_cnpj');
        elm.removeClass('invalid').parent().find('span').html('');
        e.preventDefault();
        var cnpj = elm.val();
        var data = valida_cnpj(cnpj);
            if(data == 0){
                $('html, body').animate({
                    scrollTop: elm.offset().top - 300
                }, 800,function(){
                    elm.addClass('invalid').parent().find('span').html('* CNPJ Inválido');
                    elm.focus();
                    elm.val('');
                    valid = false;
                });
            }
            if(data == 1){

            }


    });

    function calc_digitos_posicoes( digitos, posicoes = 10 , soma_digitos = 0 ) {

        // Garante que o valor é uma string
        digitos = digitos.toString();

        // Faz a soma dos dígitos com a posição
        // Ex. para 10 posições:
        //   0    2    5    4    6    2    8    8   4
        // x10   x9   x8   x7   x6   x5   x4   x3  x2
        //   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
        for ( var i = 0; i < digitos.length; i++  ) {
            // Preenche a soma com o dígito vezes a posição
            soma_digitos = soma_digitos + ( digitos[i] * posicoes );

            // Subtrai 1 da posição
            posicoes--;

            // Parte específica para CNPJ
            // Ex.: 5-4-3-2-9-8-7-6-5-4-3-2
            if ( posicoes < 2 ) {
                // Retorno a posição para 9
                posicoes = 9;
            }
        }

        // Captura o resto da divisão entre soma_digitos dividido por 11
        // Ex.: 196 % 11 = 9
        soma_digitos = soma_digitos % 11;

        // Verifica se soma_digitos é menor que 2
        if ( soma_digitos < 2 ) {
            // soma_digitos agora será zero
            soma_digitos = 0;
        } else {
            // Se for maior que 2, o resultado é 11 menos soma_digitos
            // Ex.: 11 - 9 = 2
            // Nosso dígito procurado é 2
            soma_digitos = 11 - soma_digitos;
        }

        // Concatena mais um dígito aos primeiro nove dígitos
        // Ex.: 025462884 + 2 = 0254628842
        var cpf = digitos + soma_digitos;

        // Retorna
        return cpf;

    } // calc_digitos_posicoes

    function valida_cnpj( valor ) {
        // Garante que o valor é uma string
        valor = valor.toString();

        // Remove caracteres inválidos do valor
        valor = valor.replace(/[^0-9]/g, '');


        // O valor original
        var cnpj_original = valor;

        // Captura os primeiros 12 números do CNPJ
        var primeiros_numeros_cnpj = valor.substr( 0, 12 );

        // Faz o primeiro cálculo
        var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );

        // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
        var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );

        // Concatena o segundo dígito ao CNPJ
        var cnpj = segundo_calculo;

        // Verifica se o CNPJ gerado é idêntico ao enviado
        if ( cnpj === cnpj_original ) {
            return true;
        }

        // Retorna falso por padrão
        return false;

    }
    // Fim valida CNPJ



    
});
