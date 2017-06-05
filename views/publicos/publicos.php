<?php

use yii\helpers\Url;
use yii\web\View;
use yii\web\JqueryAsset;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chat público';

$urlConectados = Url::to(['ajax/conectados']);
$urlmsg = Url::to(['ajax/publicosmsg']);
$urlenviar = Url::to(['publicos/enviar']);

$js = <<<EOT

var urlConectados = "$urlConectados";
var urlmsg ="$urlmsg";
var urlenviar = "$urlenviar";

EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxPublicos.js',
    ['depends' => [JqueryAsset::className()]]
);
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
                    <input type="text" class="form-control" id="mensaje" placeholder="" autofocus="true" maxlength="140"/>
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
