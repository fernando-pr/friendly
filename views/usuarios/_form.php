<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;
use yii\web\JqueryAsset;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$urlProvincia = Url::to(['provincias/provincias']);
$urlPoblacion = Url::to(['poblacion/poblacion']);
$provincia = $model->provincia;
$poblacion = $model->poblacion;
$js = <<<EOT

var urlProvincia = "$urlProvincia";
var urlPoblacion = "$urlPoblacion";

EOT;
$this->registerJs($js, View::POS_END);
$this->registerJsFile(
    '/js/ajaxUsuarios_form.js',
    ['depends' => [JqueryAsset::className()]]
);

?>
<div class="usuario-form">

    <?php $form = ActiveForm::begin(['id' => 'form-registro']); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passConfirm')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->dropDownList(['' => 'Selecciona una provincia...']);?>

    <?= $form->field($model, 'poblacion')->dropDownList(['' => 'Selecciona una población...']);?>

    <?php if(!$model->isNewRecord){ ?>
        <?= $form->field($model, 'imageFile')->fileInput(['maxlength' => true]) ?>
        <?php } ?>
        <br><br>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Registrar' : 'Modificar', ['class' => $model->isNewRecord ? 'btn btn-success crear' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
