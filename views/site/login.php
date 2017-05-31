<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = 'Inicio Sesión';

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



?>
<div class="site-login container">
   <div id="login" class="signin-card">
      <div class="logo-image">
         <img src="/logo.png" alt="Logo" title="Logo" width="80">
         <h1 class="display1">Friendly</h1>
      </div>
<br><br>
      <?php $form = ActiveForm::begin([
         'id' => 'login-form',
         'layout' => 'horizontal',
      ]); ?>

      <div id="form-login-username" class="form-group">
         <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
      </div>
      <div id="form-login-password" class="form-group">
         <?= $form->field($model, 'password')->passwordInput() ?>
      </div>
      <!-- <div id="form-login-remember" class="form-group">
         <!-- <div class="checkbox checkbox-default">
             <!-- <?= $form->field($model, 'rememberMe')->checkbox([
                 //'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                 ]) ?> -->
            <!-- </div> -->
         <!-- </div> -->

            <div>
               <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn btn-block btn-info ripple-effect', 'name' => 'login-button']) ?>
            </div>
            <br>
            <div>
               <button type="button" name="button" class="btn btn-primary btn btn-block btn-info ripple-effect registrate">Registrate</button>
            </div>

         <?php ActiveForm::end(); ?>

      </div>
   </div>
