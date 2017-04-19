<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$url = Url::to(['provincias/provincias']);
$url2 = Url::to(['poblacion/poblacion']);
$provincia = $model->provincia;
$poblacion = $model->poblacion;
$js = <<<EOT

$(document).on('ready', function () {

    function provincias(r){

        for (i in r){
            $("#usuario-provincia").append("<option name="+ i +" value="+r[i]+">"+r[i]+"</option>")
        }
        ordenar();

        if('$provincia' != null){
            marcarProvincia();
        }
        if('$poblacion' != null){
            peticionCiudades();
        }

    }

    function marcarProvincia(){

        $("option[value="+'$provincia'+"]").attr("selected",true)
    }

    function marcarPoblacion(){

        $("option[value="+'$poblacion'+"]").attr("selected",true)
    }



    (function(){
        $.ajax({
            type: "POST",
            dataType: "JSON",
            success:provincias,
            url: '$url'
        });

    })();

    function ordenar(){
        $("select").each(function() {
            //guardamos la opción seleccionada
            var sel = $(this)[0].selectedIndex;

            //ordenamos las opciones
            $(this).html($("option", $(this)).sort(function(a, b) {
                //   return a.text == b.text ? 0 : a.text < b.text ? -1 : 1 //ordena por texto
                return a.value == b.value ? 0 : a.value < b.value ? -1 : 1 //ordena por atributo value
            }));

            // Reestablecimiento de la opción seleccionada previamente
            $(this)[0].selectedIndex = sel; //$(this).prop('selectedIndex', sel);


        });
    }

    $("#usuario-provincia").on("change", peticionCiudades);

    function poblacion(r){
        for (i in r){
            $("#usuario-poblacion").append("<option value ="+r[i]+">"+r[i]+"</option>")
        }
        ordenar();

        if('$poblacion' != null){
            marcarPoblacion();
        }

    }

    function peticionCiudades(){

        var dato = $("#usuario-provincia option:selected").attr('name');//val();

        $.ajax({
            data: 'provincia=' + dato,
            type: "POST",
            dataType: "JSON",
            success:poblacion,
            url: '$url2'
        });

    }

});
EOT;
$this->registerJs($js);


?>
<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pass')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passConfirm')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provincia')->dropDownList(['' => 'Provincias...']);?>

    <?= $form->field($model, 'poblacion')->dropDownList(['' => 'Poblaciones...']);?>

    <?php if(!$model->isNewRecord){ ?>
        <?= $form->field($model, 'imageFile')->fileInput(['maxlength' => true]) ?>
    <?php } ?>
    <br><br>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success crear' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
