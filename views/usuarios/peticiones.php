<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

?>
<div class="usuarios-peticiones">
    <div class="text-center">
        <h1>Peticiones de amistad</h1>
    </div>
    <?php
    foreach ($model as $usuario) {

        $esAmigo = Yii::$app->user->getEsMiAmigo($usuario->id);
        $soyYo = Yii::$app->user->id == $usuario->id;

        if (!$esAmigo && !$soyYo && !$usuario->esAdmin()){
            ?>
            <fieldset>
                <legend></legend>
            </fieldset>
            <div id="foto">
                <fieldset>
                    <legend><?= $usuario->nombre ?></legend>
                    <img src="<?= $usuario->imageUrl ?>" />
                </fieldset>

                <fieldset>
                    <legend>Datos</legend>
                    <div class="datos">
                        <?= "Nombre: " . $usuario->nombre ?><br>
                        <?= "Población: " . $usuario->poblacion ?><br>
                        <?= "Provincia: " . $usuario->provincia ?>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>
                        Opciones
                    </legend>
                    <div class="opciones">
                        <?= Html::a('Aceptar Amigo', ['/amigos/aceptar', 'id' => $usuario->id], ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Rechazar', ['/amigos/rechazar', 'id' => $usuario->id], ['class' => 'btn btn-danger']) ?>
                    </div>
                </fieldset>

            </div>

            <br>
            <?php
        }
    }
    ?>
    <div class="botones_abajo">
        <div class="botonvolver">
            <?= Html::a('Volver', ['/site/volver'], ['class' => 'btn btn-warning btn-lg btn-block']) ?>
        </div>
    </div>
</div>
