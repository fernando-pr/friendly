<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\helpers\Mensaje;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Alert;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

$js = <<<JS
$(".exito").fadeTo(2000, 500).slideUp(500, function() {
    $(".exito").slideUp(500);
});
$(".exito").css({
    position: 'relative',
    width: '200px',
    height: '60px',
    'margin-Left':'40%'
});

JS;
$this->registerJs($js);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?php $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => '/logo.png']); ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        if (!Yii::$app->user->isGuest && Yii::$app->requestedRoute != "site/reproductor"){
            NavBar::begin([
                'brandLabel' => '<img src="/logo.png" alt="Logo" title="Logo" width="30" class="logo">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top barra_navegacion',
                ],
            ]);

            $ruta = Yii::$app->request->baseUrl . 'uploads' . '/' . Yii::$app->user->identity->id . '.png';

            if (!file_exists($ruta)){
                $ruta = Yii::$app->request->baseUrl . 'uploads' . '/default.png';
            }

            if (Yii::$app->user->esAdmin) {
                $items = [
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . '<div class="fotos_login">'
                    . Html::submitButton(
                        '<img src="/encendido.png" width="37" height="37" title="Cerrar Sesión">',
                        ['class' => 'btn btn-link logout']
                        )
                        . '</div>'
                        . Html::endForm()
                        . '</li>'

                    ];
                } else {
                    $items = [

                        Yii::$app->user->isGuest ? (
                            ['label' => 'Login', 'url' => ['/site/login']]
                            ) : (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post')

                                . '<div class="fotos_login">'
                                . Html::a('<img src="/img/grupo.png" width="37" height="37", class="img-circle">', ['publicos/publicos'], ['class' => 'img-circle', 'title'=>'chat grupo'] ) . ' '
                                . Html::a('<img src="/img/chat.png" width="37" height="37", class="img-circle">',['privados/privados'], ['class' => 'img-circle', 'title'=>'chat']) . ' '
                                . Html::a('<img src="/img/amistad.jpg" width="37" height="37", class="img-circle">', ['amigos/amigos'], ['class' => 'img-circle', 'title'=>'Amigos']) . ' '
                                . Html::a('<img src="/img/peticion.png" width="37" height="37", class="img-circle">', ['usuarios/peticiones'], ['class' => 'img-circle', 'title'=>'Peticiones Amistad']) . ' '
                                . Html::a('<img src="/' . $ruta . '" width="37" height="37", class="img-circle">',['usuarios/view/' . Yii::$app->user->id], ['class' => 'img-circle', 'title'=>'perfil ' . Yii::$app->user->identity->nombre]) . ' '
                                . Html::a('<img src="/img/play.jpg" width="37" height="37", class="img-circle play_musica">',[''], ['class' => 'img-circle play', 'title'=>'reproductor de música ']) . ' '

                                . Html::submitButton(
                                    '<img src="/encendido.png" width="37" height="37" title="Cerrar Sesión">',
                                    ['class' => 'btn btn-link logout']
                                    )
                                    . '</div>'
                                    . Html::endForm()
                                    . '</li>'
                                    )
                                ];
                            }
                            // if (Yii::$app->user->isGuest) {
                            //     //Añadir aqui apartados de usuarios invitados
                            //     array_unshift($items,  ['label' => 'Registrarse', 'url' => ['usuarios/create']]);
                            // }


                            if (!Yii::$app->user->isGuest && !Yii::$app->user->esAdmin) {
                                $peticiones = Yii::$app->user->numPeticionesUsuario();

                                //Añadir aqui apartados de usuarios registrados
                                //    array_unshift($items, ['label' => 'Mi perfil', 'url' => ['usuarios/view/' . Yii::$app->user->id]]);
                                // if ($peticiones > 0){
                                //     array_unshift($items, ['label' => 'peticiones (' . $peticiones . ')', 'url' => ['usuarios/peticiones']]);
                                // } else {
                                //     array_unshift($items, ['label' => 'peticiones', 'url' => ['usuarios/peticiones']]);
                                // }
                                // array_unshift($items, ['label' => 'Amigos', 'url' => ['amigos/amigos']]);
                                // array_unshift($items, ['label' => 'Chat', 'url' => ['privados/privados']]);
                                // array_unshift($items, ['label' => 'Foro', 'url' => ['publicos/publicos']]);
                            }

                            if (Yii::$app->user->esAdmin) {
                                //Añadir aqui apartados de usuarios administrador
                                array_unshift($items, ['label' => 'Mensajes foro', 'url' => ['publicos/index']]);
                                array_unshift($items, ['label' => 'Mensajes Chat', 'url' => ['privados/index']]);
                                array_unshift($items, ['label' => 'Amistad', 'url' => ['amigos/index']]);
                                array_unshift($items, ['label' => 'Conectados', 'url' => ['conectados/index']]);
                                array_unshift($items, ['label' => 'Usuarios', 'url' => ['usuarios/index']]);

                            }

                            echo Nav::widget([
                                'options' => ['class' => 'navbar-nav navbar-right'],
                                'items' => $items,
                            ]);
                            NavBar::end();
                        }
                        ?>

                        <div class="container">
                            <?= Breadcrumbs::widget([
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                                <?php if (Mensaje::hayExito()) {
                                    echo Alert::widget([
                                        'closeButton' => false,
                                        'options' => [
                                            'class' => 'alert-success exito',
                                        ],
                                        'body' => Mensaje::exito(),
                                    ]);
                                } ?>
                                <?php if (Mensaje::hayFracaso()) {
                                    echo Alert::widget([
                                        'closeButton' => false,
                                        'options' => [
                                            'class' => 'alert-danger fracaso',
                                        ],
                                        'body' => Mensaje::fracaso(),
                                    ]);
                                } ?>

                                <?php if (Mensaje::hayInfo()) {
                                    echo Alert::widget([
                                        'options' => [
                                            'class' => 'alert-info',
                                        ],
                                        'body' => Mensaje::info(),
                                    ]);
                                } ?>
                                <?= $content ?>
                            </div>
                        </div>

                        <footer class="footer">
                            <div class="container">
                                <p class="pull-left">&copy; Friendly <?= date('Y') ?></p>
                                <p class="pull-right">
                                    <?= Html::a('Sobre nosotros',['/site/about'], ['title'=>'sobre nosotros']) ?>
                                </p>
                            </div>
                        </footer>
                        <?php $this->endBody() ?>
                    </body>
                    </html>
                    <?php $this->endPage() ?>
