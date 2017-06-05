<?php

use yii\helpers\Url;
use yii\web\View;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chat Privado';

$urlConectados = Url::to(['ajax/amigosconectados']);
$urlmsg = Url::to(['ajax/privadosmsg']);
$urlnombre = Url::to(['ajax/nombre']);
$urlenviar = Url::to(['privados/enviar']);

$js = <<<EOT

var urlConectados = "$urlConectados";
var urlmsg ="$urlmsg";
var urlnombre = "$urlnombre";
var urlenviar = "$urlenviar";

EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxPrivados.js',
    ['depends' => [JqueryAsset::className()]]
);
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
