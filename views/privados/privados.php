<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chat Privado';

$url = Url::to(['ajax/amigosconectados']);
$urlmsg = Url::to(['ajax/privadosmsg']);
$urlnombre = Url::to(['ajax/nombre']);
$urlenviar = Url::to(['privados/enviar']);
$js = <<<EOT

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
            url: '$url',
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
            url: '$urlmsg',
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
            url: '$urlnombre',
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
            url: '$urlenviar',
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
EOT;
$this->registerJs($js);
?>
<br />
<div class="chat-index">
    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Amigos conectados
            </div>
            <div class="panel-body panel_conectados" id="conectados_caja">
                <ul class="media-list amigos_conectados">
                    <!-- Amigos conectados -->
                </ul>
            </div>
        </div>

    </div>
    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                <p class="nombre_amigo">Mensajes recientes</p>
            </div>
            <div class="panel-body caja_mensajes_publicos" id="chat_publico">

            </div>




            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" autofocus="true" id="mensaje"/>
                    <span class="input-group-btn">
                        <button class="btn btn-info enviar" type="button">Enviar</button>
                    </span>
                </div>
            </div>




        </div>

    </div>


</div>
