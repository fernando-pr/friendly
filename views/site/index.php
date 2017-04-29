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

    <h1>Personas cerca</h1>

    <?php
    if (!empty($model)) { ?>

        <?php

        foreach ($model as $usuario) {

            $esAmigo = Yii::$app->user->getEsMiAmigo($usuario->id);
            $soyYo = Yii::$app->user->id == $usuario->id;
            $meHaEnviadoAmistad = Yii::$app->user->meHaEnviadoAmistad($usuario->id);
            if (!$esAmigo && !$soyYo && !$usuario->esAdmin() && $meHaEnviadoAmistad){

                $ruta = '../usuarios/view/' . $usuario->id; ?>

                <fieldset>
                    <legend></legend>
                </fieldset>
                <div id="foto">
                    <fieldset>
                        <legend><?= $usuario->nombre ?></legend>
                        <div class="fotos">
                            <img src="<?= $usuario->imageUrl ?>" title="<?= $usuario->nombre ?>"/>
                        </div>
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
                            <?php if(!Yii::$app->user->estaPeticionEnviada($usuario->id)) { ?>
                                <?= Html::a('Solicitud Amistad', ['/amigos/solicitud', 'id' => $usuario->id], ['class' => 'btn btn-primary']) ?>
                                <?php } else { ?>
                                    <?= Html::a('Cancelar Solicitud', ['/amigos/cancelar', 'id' => $usuario->id], ['class' => 'btn btn-danger']) ?>
                                    <?php } ?>
                                </div>
                            </fieldset>

                        </div>

                        <br>
                        <?php
                    }
                }
            }
            ?>
        </div>
