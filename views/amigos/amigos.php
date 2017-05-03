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

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad" >

                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h1 class="panel-title"><?= $usuario->nombre?></h1>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="No imagen" src="<?= $usuario->imageUrl ?>" class="img-circle img-responsive"> </div>

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
                                <?= Html::a('Borrar Amigo', ['/amigos/borrar', 'id' => $usuario->id], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Seguro que desea dejar de ser amigo de ' . $usuario->nombre,
                                        'method' => 'post',
                                    ],
                                    ]) ?>

                                </div>

                            </div>
                        </div>
                    </div>


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
