<?php

use yii\helpers\Html;

if (!empty($model)) { ?>

    <?php

    foreach ($model as $usuario) {

        $esAmigo = Yii::$app->user->getEsMiAmigo($usuario->id);
        $soyYo = Yii::$app->user->id == $usuario->id;
        $meHaEnviadoAmistad = Yii::$app->user->meHaEnviadoAmistad($usuario->id);
        $estaPeticionEnviada = Yii::$app->user->estaPeticionEnviada($usuario->id)==true;

        if (!$soyYo && !$usuario->esAdmin() ){
            ?>



            <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
                <div class="">
                    <ul class="list-group">
                        <li class="list-group-item">

                            <div class="row">
                                <div class="col-md-4">
                                    <img alt="No imagen" src="<?= $usuario->imageUrl ?>" class="img-circle img-responsive img_buscar">
                                    <?= $usuario->nombre?>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <?= $usuario->poblacion?>
                                        (<?=$usuario->provincia?>)
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <?php if(!$esAmigo && !Yii::$app->user->estaPeticionEnviada($usuario->id)) { ?>
                                            <?= Html::a('Solicitud Amistad', ['/amigos/solicitud', 'id' => $usuario->id, 'redirect' => 'si'], ['class' => 'btn btn-primary']) ?>
                                            <?php
                                        } else if(!$esAmigo && Yii::$app->user->estaPeticionEnviada($usuario->id)) {
                                            ?>
                                            <?= Html::a('Cancelar Solicitud', ['/amigos/cancelar', 'id' => $usuario->id, 'redirect' => 'si'], ['class' => 'btn btn-danger']) ?>
                                            <?php
                                        } else if($esAmigo) {
                                            ?>
                                            <?= Html::a('Ver Perfil', ['/usuarios/view/' . $usuario->id], ['class' => 'btn btn-info']) ?>
                                            <br>
                                            <?= Html::a('Borrar Amigo', ['/amigos/borrar', 'id' => $usuario->id], ['class' => 'btn btn-danger']) ?>

                                            <?php
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>



            <?php
        }
    }
} else { ?>

    <div class="col-xs-8 col-sm-8 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">
        <div class="">
            <ul class="list-group">
                <li class="list-group-item">

                    <div class="row">
                        <div class="col-md-8">
                            <p>No se encontraron coincidencias</p>
                        </div>

                    </div>
                </li>

            </ul>
        </div>

    </div>


    <?php
}
?>
