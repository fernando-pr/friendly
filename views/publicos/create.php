<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publico */

$this->title = 'Create Publico';
$this->params['breadcrumbs'][] = ['label' => 'Publicos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publico-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
