<?php

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
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

                    <div class="">
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
