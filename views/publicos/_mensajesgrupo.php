<?php

use yii\helpers\Html;


if (!empty($model)) { ?>

    <ul class="media-list">
        <?php foreach ($model as $publico) {
            $media = 'media';
            $pull = 'pull-left';
            ?>
            <!-- Cada li es un mensaje de un usuario ---------------------------------------------- -->

            <?php if ($publico->usuario->id == Yii::$app->user->id) {
                $media = 'media oscura';
                $pull = 'pull-right';
            } ?>
            <li class="<?= $media ?>">

                <div class="media-body">
                    <div class="media">
                        <a class="<?=$pull?>">
                            <!-- imagen del usuario que ha envidado el mensaje -->
                            <img class="media-object img-circle " src="<?= $publico->usuario->imageUrl ?>" style="width: 50px; height: 50px;"/>
                        </a>
                        <div class="media-body">
                            <p class="<?=$pull?> p_mensaje">
                                <?= Html::encode($publico->mensaje) ?>
                            </p>
                            <br /><br />
                            <p class="<?=$pull?>">
                                <small class="text-muted"><?= Html::encode($publico->usuario->nombre) ?> | <?= Yii::$app->formatter->asDatetime($publico->fecha, 'HH:mm:ss dd/MM/yyyy' ) ?></small>
                            </p>
                        </div>
                    </div>
                </div>

            </li>
            <hr />
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
