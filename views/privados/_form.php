<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Privado */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="privado-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_emisor')->textInput() ?>

    <?= $form->field($model, 'id_receptor')->textInput() ?>

    <?= $form->field($model, 'mensaje')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
