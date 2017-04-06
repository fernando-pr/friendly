<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AmigoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Amigos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="amigo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    

    <p>
        <?= Html::a('Create Amigo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
        ]) ?>
    </div>
