<?php

namespace app\controllers;

use Yii;
use app\helpers\Mensaje;
use app\models\Usuario;
use app\models\Conectado;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/**
* SiteController, controlador que se encarga de todas las acciones que
* tienen que ver con la web en general.
*/
class SiteController extends Controller
{
    /**
    * Define el comportamiento y el control de acceso a los componentes.
    * @return mixed
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return !Yii::$app->user->isGuest;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
    * Acciones y configuración del controlador
    */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
    * Muestra la página principal.
    *
    * @return string
    */
    public function actionIndex()
    {
        $provincia = Yii::$app->user->identity->provincia;
        $poblacion = Yii::$app->user->identity->poblacion;

        $yo = Usuario::findOne(Yii::$app->user->id);
        $usuarios = Usuario::find()->where(['poblacion' => $poblacion])->orWhere(['provincia' => $provincia])->all();

        $model = [];
        foreach ($usuarios as $usuario) {
            $esAmigo =  $yo->getAmistad($usuario->id) != null;
            $soyYo = Yii::$app->user->id == $usuario->id;
            $meHaEnviadoAmistad = $yo->meHaEnviadoAmistad($usuario->id);
            $estaActivado = $usuario->getActivado();
            if (!$esAmigo && !$soyYo && !$usuario->esAdmin() && !$meHaEnviadoAmistad && $estaActivado) {
                $model[] = $usuario;
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
    * Acciones para iniciar sesión.
    *
    * @return string
    */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {

            $id = Yii::$app->user->id;
            $comprobar = Conectado::findOne(['id_usuario' => $id]);
            if (!isset($comprobar)) {
                $conectado = new Conectado();
                $conectado->id_usuario = $id;
                $conectado->save();
            }

            Mensaje::exito('Bienvenido a friendly ' . $model->username);
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
    * Acciones para cerrar sesión
    *
    * @return string
    */
    public function actionLogout()
    {
        //desconectar usuario
        $id = Yii::$app->user->id;
        $conectado = Conectado::findOne(['id_usuario' => $id]);

        if (isset($conectado)) {
            $conectado->delete();
        }


        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
    * Displays contact page.
    *
    * @return string
    */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
    * Muestra la pagina about.
    *
    * @return string
    */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
    * Muestra la vistra que contiene el reproductor.
    * @return string
    */
    public function actionReproductor()
    {
        return $this->render('reproductor');
    }

    /**
    * Redirecciona a la página anterior.
    * @return string
    */
    public function actionVolver()
    {
        return $this->goBack();
    }
}
