<?php

use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chat público';

$url = Url::to(['ajax/conectados']);
$urlmsg = Url::to(['ajax/publicosmsg']);
$urlenviar = Url::to(['publicos/enviar']);
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

    // Ajax para mensajes

    var intervalo = setInterval(function(){
        obtenerMensajes();
    }, 4000);

    obtenerMensajes();
    function obtenerMensajes() {
        $.ajax({
            method: 'GET',
            url: '$urlmsg',
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
            url: '$urlenviar',
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
EOT;
$this->registerJs($js);
?>

<div class="chat-index">

    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                Mensajes recientes
            </div>
            <div class="panel-body caja_mensajes_publicos" id="chat_publico">
                <!-- Aqui van los mensajes -->
            </div>

            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control" id="mensaje" placeholder="" autofocus="true" />
                    <span class="input-group-btn">
                        <button class="btn btn-info enviar" type="button">Enviar</button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Usuarios conectados
            </div>
            <div class="panel-body panel_conectados" id="conectados_caja">
                <!-- Aqui van los usuarios conectados -->
            </div>
        </div>
    </div>
</div>
