<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = $model->id;
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <img src="<?= $model->imageUrl ?>" />

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'token',
        ],
    ]) ?>

</div>
