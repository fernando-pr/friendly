<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConectadoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conectados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conectado-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Conectado', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_usuario',
            'instante',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
