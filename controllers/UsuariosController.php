<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Amigo;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
* UsuariosController implements the CRUD actions for Usuario model.
*/
class UsuariosController extends Controller
{
    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'activar'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'update'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $id = Yii::$app->request->get('id');
                            $esAmigo = Yii::$app->user->getEsMiAmigo($id);

                            return $id === null || $id == Yii::$app->user->id || $esAmigo;
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->esAdmin;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Lists all Usuario models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new UsuarioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Usuario model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionPeticiones()
    {

        //$model = Usuario::getPeticiones();

        $peticiones = Usuario::getPeticiones();

        $model = [];
        foreach ($peticiones as $peticion) {

            $esAmigo = \Yii::$app->user->getEsMiAmigo($peticion->id);
            $soyYo = \Yii::$app->user->id == $peticion->id;

            if (!$esAmigo && !$soyYo && !$peticion->esAdmin()) {
                $model[] = $peticion;
            }
        }
        return $this->render('peticiones', [
            'model' =>$model,
        ]);
    }

    // public function actionSolicitud($id)
    // {
    //     $existePeticion = Amigo::estaPeticionEnviada($id);
    //
    //     if (!$existePeticion) {
    //         $model = new Amigo();
    //         $model->id_usuario = Yii::$app->user->id;
    //         $model->id_amigo = $id;
    //         $model->estado = 'Solicitado';
    //         $model->save();
    //     }
    //
    //     return $this->goBack();
    // }
    //
    // public function actionCancelar($id)
    // {
    //     $existePeticion = Amigo::estaPeticionEnviada($id);
    //
    //     if ($existePeticion) {
    //         $cond = ['id_usuario' => Yii::$app->user->id, 'id_amigo' => $id];
    //         $model = Amigo::findOne($cond);
    //         $model->delete();
    //     }
    //
    //     return $this->goBack();
    // }


    public function actionActivar($token)
    {
        $usuario = Usuario::findOne(['activacion' => $token]);

        if ($usuario === null) {
            throw new NotFoundHttpException('El usuario indicado no existe.');
        }

        $usuario->activacion = null;
        $usuario->save(false);
        Yii::$app->session->setFlash(
            'exito',
            'Usuario validado correctamente.'
        );
        return $this->redirect(['site/login']);
    }

    /**
    * Creates a new Usuario model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Usuario([
            'scenario' => Usuario::ESCENARIO_CREATE
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->activacion = Yii::$app->security->generateRandomString();
            $model->save(false);
            if (Yii::$app->user->isGuest) {
                $url = Url::to(['usuarios/activar', 'token' => $model->activacion], true);
                Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['smtpUsername'])
                ->setTo($model->email)
                ->setSubject('Activación de cuenta')
                ->setHtmlBody("Por favor, pulse en el siguiente enlace
                para activar su cuenta:<br/>
                <a href=\"$url\">Pinche aquí</a>")
                ->send();

                Yii::$app->session->setFlash(
                    'exito',
                    'Usuario creado correctamente. Por favor,mire su correo.'
                );
            }
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('aceptar');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Updates an existing Usuario model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Deletes an existing Usuario model.
    * If deletion is successful, the browser will be redirected to the 'index' page.
    * @param integer $id
    * @return mixed
    */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
    * Finds the Usuario model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Usuario the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        $id = $id ?? Yii::$app->user->id;
        if (($model = Usuario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Esta página no existe');
        }
    }
}
