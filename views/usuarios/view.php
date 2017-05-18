<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Perfil ' . $model->nombre;


?>
<div class="usuario-view">
    <div class="text-center">
        <?php if ($model->id == Yii::$app->user->id) { ?>
            <h1>Mi Perfil</h1>
            <?php
        }  else {
            ?>
            <h1>Perfil de <?= $model->nombre ?></h1>
            <?php
        }
        ?>
    </div>
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xs-offset-0 col-sm-offset-0 col-md-offset-1 col-lg-offset-1 toppad" >

            <div class="panel panel-info caja_perfil">
                <div class="panel-heading">
                    <h1 class="panel-title"><?= $model->nombre?></h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="No imagen" src="<?= $model->imageUrl ?>" class="img-circle img-responsive"> </div>

                        <div class=" col-md-9 col-lg-9 ">
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>Nombre</td>
                                        <td><?= $model->nombre?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?= $model->email?></td>
                                    </tr>
                                    <tr>
                                        <td>Población</td>
                                        <td><?= $model->poblacion?></td>
                                    </tr>
                                    <tr>
                                        <td>Provincia</td>
                                        <td><?= $model->provincia?></td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <?php if ($model->id == Yii::$app->user->id) {?>
                        <?= Html::a('<img src="/editar.png" height="20" width="20"/>', ['update', 'id' => $model->id], ['class' => 'btn btn-sm btn-primary', 'data-toggle'=>"tooltip"]) ?>
                        <?php
                    }
                    ?>
                    <span class="pull-right">
                        <?php if ($model->id == Yii::$app->user->id) {?>
                            <?= Html::a('X', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => '¿Seguro que desear borrar tu usuario?',
                                    'method' => 'post',
                                ],
                                ]) ?>
                                <?php
                            }
                            ?>
                        </span>
                    </div>

                </div>
            </div>
        </div>
        <div class="botones_abajo">
            <div class="botonvolver">
                <?= Html::a('Volver', ['/site/volver'], ['class' => 'btn btn-warning btn-lg btn-block']) ?>
            </div>
        </div>
    </div>
