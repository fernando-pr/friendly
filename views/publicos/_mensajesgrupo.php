<?php

use yii\helpers\Html;

if (!empty($model)) { ?>

    <ul class="media-list">
        <?php foreach ($model as $publico) {
            ?>

            <!-- Cada li es un mensaje de un usuario ---------------------------------------------- -->
            <li class="media">
                <div class="media-body">
                    <div class="media">
                        <a class="pull-left" href="#">
                            <!-- imagen del usuario que ha envidado el mensaje -->
                            <img class="media-object img-circle " src="<?= $publico->usuario->imageUrl ?>" style="width: 50px; height: 50px;"/>
                        </a>
                        <div class="media-body" >
                            <?= $publico->mensaje ?>
                            <br />
                            <small class="text-muted"><?= $publico->usuario->nombre ?> | <?= Yii::$app->formatter->asDatetime($publico->fecha, 'HH:mm:ss dd/MM/yyyy' ) ?></small>
                            <hr />
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
                        <p>No hay mensajes</p>
                    </div>
                </div>
            </li>
            <!--  -->
        </ul>


        <?php
    }
    ?>
