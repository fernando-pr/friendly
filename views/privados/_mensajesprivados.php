<?php



if (!empty($model)) { ?>

    <ul class="media-list">
        <?php foreach ($model as $privado) {

            $media = 'media';
            $pull = 'pull-left';
            ?>
            <!-- Cada li es un mensaje de un usuario ---------------------------------------------- -->

            <?php if ($privado->emisor->id == Yii::$app->user->id) {
                $media = 'media oscura';
                $pull = 'pull-right';
            } ?>

            <li class="<?= $media ?>">
                <div class="media-body">
                    <div class="media">
                        <a class="<?=$pull?>">
                            <!-- imagen del usuario que ha envidado el mensaje -->
                            <img class="media-object img-circle " src="<?= $privado->emisor->imageUrl ?>" style="width: 50px; height: 50px;"/>
                        </a>
                        <div class="media-body">
                            <p class="<?=$pull?> p_mensaje">
                                <?= Html::encode($privado->mensaje) ?>
                            </p>
                            <br /><br />
                            <p class="<?=$pull?>">
                                <small class="text-muted"><?= Html::encode($privado->emisor->nombre) ?> | <?= Yii::$app->formatter->asDatetime($privado->fecha, 'HH:mm:ss dd/MM/yyyy' ) ?></small>
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
