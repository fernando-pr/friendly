<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Amigo */

$this->title = 'Create Amigo';
$this->params['breadcrumbs'][] = ['label' => 'Amigos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amigo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
