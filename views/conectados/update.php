<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Conectado */

$this->title = 'Update Conectado: ' . $model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => 'Conectados', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_usuario, 'url' => ['view', 'id' => $model->id_usuario]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="conectado-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
