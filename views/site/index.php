<?php

use yii\helpers\Html;

$this->title = 'My Yii Application';
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

            if (!$esAmigo && !$soyYo && !$usuario->esAdmin()){

                $ruta = '../usuarios/view/' . $usuario->id; ?>
                <fieldset>
                    <legend>
                        <?= "<a href=" . $ruta . ">" .$usuario->nombre . "</a>" ?>
                    </legend>

                    <div class="fotos">
                        <img src="<?= $usuario->imageUrl ?>" />
                        <?= $usuario->nombre ?>
                    </div>
                </fieldset>
                <br>



                <?php
            }
        }
    }
    ?>
</div>
