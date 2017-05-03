<?php

use yii\helpers\Html;

$this->title = 'friendly';
?>

<?php
$js = <<<EOT

$(document).on('ready', function () {
    $(".galeria").galeriaImg();
});
EOT;
$this->registerJs($js);
?>

<div class="site-index">
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

            $esAmigo = Yii::$app->user->getEsMiAmigo($usuario->id);
            $soyYo = Yii::$app->user->id == $usuario->id;
            $meHaEnviadoAmistad = Yii::$app->user->meHaEnviadoAmistad($usuario->id);

            if (!$esAmigo && !$soyYo && !$usuario->esAdmin() && $meHaEnviadoAmistad){
                ?>

                <div class="row caja_principal">

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad">

                        <div class="panel panel-info caja_perfil">
                            <div class="panel-heading">

                                <h1 class="panel-title"><?= $usuario->nombre?></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="No imagen" src="<?= $usuario->imageUrl ?>" class="img-circle img-responsive imagen"> </div>

                                    <div class=" col-md-9 col-lg-9 ">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <td>Nombre</td>
                                                    <td><?= $usuario->nombre?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td>
                                                    <td><?= $usuario->email?></td>
                                                </tr>
                                                <tr>
                                                    <td>Población</td>
                                                    <td><?= $usuario->poblacion?></td>
                                                </tr>
                                                <tr>
                                                    <td>Provincia</td>
                                                    <td><?= $usuario->provincia?></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <?php if(!Yii::$app->user->estaPeticionEnviada($usuario->id)) { ?>
                                    <?= Html::a('Solicitud Amistad', ['/amigos/solicitud', 'id' => $usuario->id], ['class' => 'btn btn-primary']) ?>
                                    <?php
                                } else {
                                    ?>
                                    <?= Html::a('Cancelar Solicitud', ['/amigos/cancelar', 'id' => $usuario->id], ['class' => 'btn btn-danger']) ?>
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
    }
    ?>
</div>
