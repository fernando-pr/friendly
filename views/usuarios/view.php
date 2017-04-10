<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'Perfil ' . $model->nombre;
$this->params['breadcrumbs'][] = (Yii::$app->user->esAdmin) ? ['label' => 'Usuarios', 'url' => ['index']] : 'Usuarios';
$this->params['breadcrumbs'][] = $model->nombre;
?>
<div class="usuario-view">


    <h1><?= Html::encode($model->nombre) ?></h1>

    <p>
        <?php if ($model->id == Yii::$app->user->id) {?>
        <?= Html::a('Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
           'class' => 'btn btn-danger',
           'data' => [
               'confirm' => '¿Seguro que desear borrar tu usuario?',
               'method' => 'post',
           ],
      ]) ?>
         <?php } ?>

    </p>

   <img src="<?= $model->imageUrl ?>" />


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'nombre',
            'email:email',
            'poblacion',
            'provincia',


        ],
    ]) ?>

</div>
