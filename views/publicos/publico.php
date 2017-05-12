<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chat público';

$js = <<<EOT

$(document).on('ready', function () {

    bajarScroll();


    // Eventos
    $('.enviar').on("click", bajarScroll);


    // Funciones
    function bajarScroll(){
        document.getElementById('chat_publico').scrollTop=document.getElementById('chat_publico').scrollHeight;
        document.getElementById('conectados_caja').scrollTop=document.getElementById('conectados_caja').scrollHeight;
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
                <ul class="media-list">

                    <!-- Cada li es un mensaje de un usuario ---------------------------------------------- -->
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <!-- imagen del usuario que ha envidado el mensaje -->
                                    <img class="media-object img-circle " src="/uploads/2.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    <br />
                                    <small class="text-muted">demo | 12 Mayo a 12:00pm</small>
                                    <hr />
                                </div>
                            </div>

                        </div>
                    </li>
                    <!-- ------------------------------------------------------- -->

                    <li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/3.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    <br />
                                    <small class="text-muted">Paco | 12 Mayo a 12:00pm</small>
                                    <hr />
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/4.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    <br />
                                    <small class="text-muted">pepe | 12 Mayo a 12:00pm</small>
                                    <hr />
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/5.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                    laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                    voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    <br />
                                    <small class="text-muted">jose | 12 Mayo a 12:00pm</small>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </li>
                    <!--  -->
                </ul>


            </div>




            <div class="panel-footer">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="" autofocus="true" />
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
                <ul class="media-list">
                    <li class="media">
                        <div class="media-body">
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <!--  -->
                                    <img class="media-object img-circle " src="/uploads/2.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Demo </h5>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!--  -->

                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/3.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Paco </h5>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/4.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>pepe</h5>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/5.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Jose</h5>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/5.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Jose</h5>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/5.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Jose</h5>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/5.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Jose</h5>
                                </div>
                            </div>

                        </div>
                    </li>
                    <li class="media">

                        <div class="media-body">

                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object img-circle " src="/uploads/5.png" style="width: 50px; height: 50px;"/>
                                </a>
                                <div class="media-body" >
                                    <h5>Jose</h5>
                                </div>
                            </div>

                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
