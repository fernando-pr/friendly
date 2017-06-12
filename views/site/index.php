<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\web\View;
use yii\web\JqueryAsset;

$this->title = 'friendly';
?>

<?php
$js = <<<EOT

// llamada al plugin de galeria de imagenes.
$(document).on('ready', function () {
    $(".galeria").galeriaImg();
});
EOT;
$this->registerJs($js);
?>

<?php

// Ajax para la solicitud de amistad
$urlSolicitud = Url::to(['amigos/solicitud']);
$urlCancelar = Url::to(['amigos/cancelar']);

$js = <<<EOT

var urlSolicitud = "$urlSolicitud";
var urlCancelar = "$urlCancelar";

EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxIndexSolicitud.js',
    ['depends' => [JqueryAsset::className()]]
);
?>


<?php

// Ajax para buscar personas
$urlBuscar = Url::to(['ajax/buscar']);

$js = <<<EOT

var urlBuscar = "$urlBuscar";

EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxIndexBuscar.js',
    ['depends' => [JqueryAsset::className()]]
);

?>



<div class="col-md-14">
    <div class="input-group">
        <span class="input-group-btn">
            <button class="btn btn-default boton_abrir_buscar" type="button">Buscar</button>
        </span>

        <span class="input-group-btn">
            <form>

                <select name="criterios" class="form-control lista_desple">
                    <option value="todos">Criterios Todos</option>
                    <option value="nombre">Nombre</option>
                    <option value="poblacion">Población</option>
                    <option value="provincia">Provincia</option>

                </select>
                <input type="submit" name="vacio" value="" title="vacio" class="vacio">
            </form>

        </span>
        <span class="input-group-btn">
            <input type="text" class="form-control input_buscar col-xs-8" title="Search">
        </span>
        <span class="input-group-btn">
            <button class="btn btn-default boton_buscar" type="button" title="busca"><img src="/img/search.png" height="18" width="18" alt="buscar"></button>
        </span>
    </div>
</div>
<br>
<div id="usuarios">

</div>
<div class="site-index">
    <br>
    <div class="galeria">
        <div class="foto">

        </div>
    </div>
    <div class="text-center">
        <h1>Personas cerca</h1>
    </div>
    <?php
    if (!empty($model)) { ?>

        <?php

        foreach ($model as $usuario) {

                ?>

                <div class="row caja_principal">

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad">

                        <div class="panel panel-info caja_perfil">
                            <div class="panel-heading">

                                <h1 class="panel-title"><?= Html::encode($usuario->nombre) ?></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="No imagen" src="<?= $usuario->imageUrl ?>" class="img-circle img-responsive imagen"> </div>

                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information" summary="Tabla que muestra la información de un usuario">


                                            <tbody>

                                                <tr>
                                                    <td>Nombre</td>
                                                    <td><?= Html::encode($usuario->nombre) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?= Html::encode($usuario->email) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Población</td>
                                                    <td><?= Html::encode($usuario->poblacion) ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Provincia</td>
                                                    <td><?= Html::encode($usuario->provincia) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">

                                <?php $peticion = Yii::$app->user->estaPeticionEnviada($usuario->id)==true;

                                ?>

                                <?php if(!Yii::$app->user->estaPeticionEnviada($usuario->id)) { ?>
                                    <input type="button" name="<?=$usuario->id?>" value="Solicitud Amistad" class='btn btn-primary boton_solicitud' title="solicitud">
                                    <input type="button" name="<?=$usuario->id?>" value="Cancelar Petición" class='btn btn-danger cancelar_peticion oculto' title="cancelar">

                                    <?php
                                } else {
                                    ?>
                                    <input type="button" name="<?=$usuario->id?>" value="Solicitud Amistad" class='btn btn-primary boton_solicitud oculto' title="slicitud">
                                    <input type="button" name="<?=$usuario->id?>" value="Cancelar Solicitud" class='btn btn-danger cancelar_peticion' title="cancela">

                                    <?php
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>


                <?php
        }
    }
    ?>
</div>
