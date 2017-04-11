<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Amigos';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php //var_dump($model); ?>
<div class="amigo-index">

    <h1><?= Html::encode($this->title) . ' de ' . Yii::$app->user->identity->nombre?></h1>


    <?php
    if (empty($model)) {?>
        <h1><?= 'No tienes amigos todavia' ?></h1>
        <?php } else { ?>

            <?php

            foreach ($model as $amigo) { ?>
                <?php $ruta = '../usuarios/view/' . $amigo->id; ?>
                <fieldset>
                    <legend>
                    <?= "<a href=" . $ruta . ">" .$amigo->nombre . "</a>" ?>
                    </legend>

                    <div class="">
                        <img src="<?= $amigo->imageUrl ?>" />
                        <?= $amigo->nombre ?>
                    </div>
                </fieldset>
                <br>

                <?php  } ?>

                <?php  } ?>
            </div>
