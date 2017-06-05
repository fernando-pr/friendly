// Ajax para las busquedas

$(document).on('ready', function () {

    var delay = (function() {
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    function buscarAjax() {
        delay(function() {
            var cond = $('.lista_desple').val();
            var q = $('.input_buscar').val();

            if (q == '') {
                $('#usuarios').html('');
            } else {

                $.ajax({
                    method: 'GET',
                    url: urlBuscar,
                    data: {
                        q: q,
                        cond:cond
                    },
                    success: function (data, status, event) {

                        $('#usuarios').html(data);
                        posicionar();
                    }
                });
            }
        }, 500);
    }

    $('.input_buscar').keyup(buscarAjax);

    $(".lista_desple").change(buscarAjax);
    $(".boton_buscar").on("click",buscarAjax);

    //posicion del div que muestra los resultados

    function posicionar() {

        $('#usuarios').css({
            "width" : '60%',
            'margin-left': '15%',
            'background-color': 'lavender',
            'height' : '40%',
            'z-index' :'2',
            'position': 'absolute',
            'overflow': 'auto'

        });
    }

});
