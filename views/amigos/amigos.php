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
<?php //var_dump($model); ?>
<div class="amigo-index">

    <h1><?= Html::encode($this->title) . ' de ' . Yii::$app->user->identity->nombre?></h1>


    <?php
    if (empty($model)) {?>
        <h1><?= 'No tienes amigos todavia' ?></h1>
        <?php } else { ?>
            <table>


                <?php

                foreach ($model as $amigo) { ?>
                    <tr>
                        <div class="">
                            <td>
                                <img src="<?= $amigo->imageUrl ?>" />
                            </td>
                            <td>
                                <?= $amigo->nombre ?>
                            </td>

                        </div>
                    </tr>
                <?php  } ?>
            </table>
    <?php  } ?>
</div>
