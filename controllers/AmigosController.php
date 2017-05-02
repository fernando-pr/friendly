<?php

namespace app\controllers;

use Yii;
use app\models\Amigo;
use app\models\Usuario;
use app\models\AmigoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
* AmigosController implements the CRUD actions for Amigo model.
*/
class AmigosController extends Controller
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
                        'actions' => ['create', 'update', 'view', 'delete', 'index'],
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Lists all Amigo models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new AmigoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * muestra los amigos del usuario logueado
    * @return mixed
    */
    public function actionAmigos()
    {
        $amigo = new Usuario();

        $model = $amigo->getAmigosUsuario();

        return $this->render('amigos', [
            'model' => $model,
        ]);
    }

    /**
    * Displays a single Amigo model.
    * @param integer $id
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Creates a new Amigo model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Amigo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
    * Updates an existing Amigo model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    */
    public function actionUpdate($id)
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
    * Deletes an existing Amigo model.
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
    * Finds the Amigo model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Amigo the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Amigo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe');
        }
    }


    public function actionSolicitud($id)
    {
        $amigo = new Amigo();
        $existePeticion =$amigo->estaPeticionEnviada($id);

        if (!$existePeticion) {
            $model = new Amigo();
            $model->id_usuario = Yii::$app->user->id;
            $model->id_amigo = $id;
            $model->estado = 'Solicitado';
            $model->save();
        }

        return $this->goBack();
    }

    public function actionCancelar($id)
    {
        $amigo = new Amigo();
        $existePeticion = $amigo->estaPeticionEnviada($id);

        if ($existePeticion) {
            $cond = ['id_usuario' => Yii::$app->user->id, 'id_amigo' => $id];
            $model = Amigo::findOne($cond);
            $model->delete();
        }

        return $this->goBack();
    }

    public function actionAceptar($id)
    {
        $amigo = new Amigo();
        $existePeticion = $amigo->estaPeticionRecibida($id);

        if ($existePeticion) {
            $cond = ['id_usuario' => $id, 'id_amigo' => Yii::$app->user->id];
            $model = Amigo::findOne($cond);
            $model->estado = 'Aceptado';

            $model->save();
        }

        return $this->redirect(['usuarios/peticiones']);
    }

    public function actionRechazar($id)
    {
        $amigo = new Amigo();
        $existePeticion = $amigo->estaPeticionRecibida($id);

        if ($existePeticion) {
            $cond = ['id_usuario' => $id, 'id_amigo' => Yii::$app->user->id];
            $model = Amigo::findOne($cond);
            $model->delete();
        }

        return $this->redirect(['usuarios/peticiones']);
    }

    public function actionBorrar($id)
    {
        $amigo = new Amigo();
        $esAmigo = $amigo->esMiAmigo($id);

        if ($esAmigo) {
            $usuario = Usuario::findOne(Yii::$app->user->id);
            $amigo = $usuario->getAmistad($id);
            $amigo->delete();
        }
        return $this->redirect(['amigos/amigos']);
    }
}
