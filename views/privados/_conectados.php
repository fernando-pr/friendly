<?php

if (!empty($model)) { ?>


    <ul class="media-list">
        <?php foreach ($model as $conectado) {
            ?>
            <li class="media">
                <div class="media-body">
                    <div class="media">
                        <a class="pull-left">
                            <img class="media-object img-circle" src="<?= $conectado->imageUrl ?>" id="<?=$conectado->id?>" style="width: 50px; height: 50px;"/>
                        </a>
                        <!-- <div class="media-body" >
                        <!-- <h5><?= $conectado->nombre ?></h5> -->
                        <!-- </div> -->
                        <div class="media-body <?=$conectado->id?>">
                            <button type="button" name="button" class="btn btn-info imagen" id="<?=$conectado->id?>">Ver Conversación con <?= $conectado->nombre?></button>
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
                            <h5>No hay amigos conectados</h5>
                        </div>
                    </div>
                </div>
            </li>
        </ul>


        <?php
    }
    ?>
