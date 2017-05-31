<?php

namespace app\controllers;

use Yii;
use app\helpers\Mensaje;
use app\models\Amigo;
use app\models\Usuario;
use app\models\Conectado;
use app\models\UploadForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
    * @inheritdoc
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
    * @inheritdoc
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
    * Displays homepage.
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
    * Login action.
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

            //usuario conectado
            //
            //isset($_COOKIE['_identity'] tambien para ver si esta conectado
            //
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
    * Logout action.
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
    * Displays about page.
    *
    * @return string
    */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionReproductor()
    {
        return $this->render('reproductor');
    }

    public function actionVolver()
    {
        return $this->goBack();
    }
}
