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



    // Ajax para mostrar la conversacion con el usuario


    // si no eliges un amigo no puedes enviar nada
    $(".enviar").attr("disabled", true);


    // Esto hace que puedas añadir evento a contenido cargado dinamicamente con ajax
    var interval;
    var id_amigo;
    $("#conectados_caja").on("click",".imagen",function(){

        //habilito el boton y le doy el foco al input del mensaje
        $(".enviar").attr("disabled", false);
        $("#mensaje").focus();

        clearInterval(interval);
        var id = $(this).attr("id");
        id_amigo = id;
        obtenerMensajes(id);
        interval = setInterval(function(){
            obtenerMensajes(id);
        }, 4000);
        // console.log($(this).attr("id"));
    })


    function obtenerMensajes(id) {

        $.ajax({
            method: 'GET',
            url: urlmsg,
            data: {
                id_amigo:id
            },
            success: function (data, status, event) {

                $("#chat_publico").empty();
                $("#chat_publico").append(data);
                bajarScroll();
                obtenerNombre(id_amigo);
            }
        });
    }

    var mensaje = null;


    //Nombre de amigo para ponerlo de titulo
    function obtenerNombre(id) {

        $.ajax({
            method: 'GET',
            url: urlnombre,
            data: {
                id_amigo:id
            },
            success: function (data, status, event) {

                $(".nombre_amigo").html("Mensajes recientes con "+data);
            }
        });
    }


    //enviar ajax al usuario indicado
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
                id_amigo: id_amigo,
                mensaje : mensaje
            },
            success: function (data, status, event) {

                obtenerMensajes(id_amigo);
                bajarScroll();
                document.getElementById("mensaje").value ="";
            }
        });

    }



});
