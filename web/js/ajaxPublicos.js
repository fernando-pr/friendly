$(document).on('ready', function () {

    bajarScroll();


    // Eventos
    $('.enviar').on("click", bajarScroll);


    // Funciones
    function bajarScroll(){
        document.getElementById('chat_publico').scrollTop=document.getElementById('chat_publico').scrollHeight;
    }


    // Ajax para conectados

    var intervalo = setInterval(function(){
        obtenerDatos();
    }, 4000);

    obtenerDatos();
    function obtenerDatos() {
        $.ajax({
            method: 'GET',
            url: urlConectados,
            data: {

            },
            success: function (data, status, event) {

                $(".panel_conectados").empty();
                $(".panel_conectados").append(data);

            }
        });
    }

    // Ajax para mensajes

    var interval = setInterval(function(){
        obtenerMensajes();
    }, 4000);

    obtenerMensajes();
    function obtenerMensajes() {
        $.ajax({
            method: 'GET',
            url: urlmsg,
            data: {

            },
            success: function (data, status, event) {

                $("#chat_publico").empty();
                $("#chat_publico").append(data);
                bajarScroll();
            }
        });
    }

    var mensaje = null;


    //Eventos para enviar mensaje, boton enviar y tecla enter
    $(".enviar").on('click', function() {
        enviarAjax();
    });

    $('body').keyup(function(e) {
        if(e.keyCode == 13) {
            enviarAjax();
        }
    });

    function enviarAjax() {
        mensaje = $("#mensaje").val();
        $.ajax({
            method: 'GET',
            url: urlenviar,
            data: {
                mensaje : mensaje
            },
            success: function (data, status, event) {

                obtenerMensajes();
                bajarScroll();
                document.getElementById("mensaje").value ="";
            }
        });

    }

});
