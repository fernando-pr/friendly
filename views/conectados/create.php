<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Conectado */

$this->title = 'Create Conectado';
$this->params['breadcrumbs'][] = ['label' => 'Conectados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conectado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
