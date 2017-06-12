<?php

use yii\helpers\Html;

if (!empty($model)) { ?>


    <ul class="media-list">
        <?php foreach ($model as $conectado) {
            ?>
            <li class="media">
                <div class="media-body">
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object img-circle " src="<?= $conectado->imageUrl ?>" style="width: 50px; height: 50px;"/>
                        </a>
                        <div class="media-body" >
                            <h5><?= Html::encode($conectado->nombre) ?></h5>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
        ?>
        <!--  -->
    </ul>

<?php } else { ?>

    <ul class="media-list">
            <li class="media">
                <div class="media-body">
                    <div class="media">
                        <div class="media-body" >
                            <h5>No hay usuarios conectados</h5>
                        </div>
                    </div>
                </div>
            </li>
    </ul>


    <?php
}
?>
