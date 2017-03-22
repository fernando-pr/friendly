<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Privado */

$this->title = 'Create Privado';
$this->params['breadcrumbs'][] = ['label' => 'Privados', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privado-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
