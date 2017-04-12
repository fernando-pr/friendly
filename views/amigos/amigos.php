<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Amigos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amigo-index">

    <?php
    if (empty($model)) {?>
        <h1><?= 'No tienes amigos todavia' ?></h1>
        <h3><a href="../">pincha aquí para ver si tienes personas cerca</a></h3>
        <?php } else { ?>
            <h1><?= Html::encode($this->title) . ' de ' . Yii::$app->user->identity->nombre?></h1>
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
                <?php
            }
        }
        ?>
    </div>
