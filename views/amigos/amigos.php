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

            foreach ($model as $usuario) { ?>

                <?php $ruta = '../usuarios/view/' . $usuario->id; ?>
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
                            <?= Html::a('Borrar Amigo', ['/amigos/borrar', 'id' => $usuario->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Seguro que desea dejar de ser amigo de ' . $usuario->nombre,
                                    'method' => 'post',
                                ],
                                ]) ?>
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
