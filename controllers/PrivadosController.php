<?php

namespace app\controllers;

use Yii;
use app\models\Privado;
use app\models\PrivadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PrivadosController implementa el CRUD y más acciones para el modelo Privados.
 */
class PrivadosController extends Controller
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
                'only' => ['create', 'update', 'view', 'delete', 'index', 'privados'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'view', 'delete', 'index', 'privados'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->esAdmin;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['privados'],
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
     * Lista todo el modelo Privado.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrivadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un único registro del modelo Privado.
     * @param int $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo registro del modelo Privado
     * Si el Privado es creado correctamente será redireccionado
     * al view de ese Privado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Privado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica un registro del modelo Privado
     * Si la modificación es satisfactoria es redireccionado al view de ese privado.
     * @param int $id
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
     * Borra un registro del modelo Privado
     * Si el borrado es satisfactorio es redireccionado a index.
     * @param int $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Este metodo envia un mensaje pasado por parametro a otro
     * usuario que sea amigo del usuario logueado.
     * @param  int  $id_amigo receptor del mensaje
     * @param  string  $mensaje  mensaje a enviar
     *
     */
    public function actionEnviar($id_amigo, $mensaje)
    {
        $id_mio = Yii::$app->user->id;

        if ($mensaje != null || $mensaje != '') {
            $model = new Privado();
            $model->id_emisor = Yii::$app->user->id;
            $model->id_receptor = $id_amigo;
            $model->mensaje = $mensaje;

            $model->load(Yii::$app->request->post());
            $model->save();
        }
    }


    /**
     * Renderiza la vista privados
     * @return mixed
     */
    public function actionPrivados()
    {
        // $conectados = Conectado::find()->all();
        // $user_conectados=[];
        // foreach ($conectados as $conectado) {
        //     $user_conectados[] = Usuario::findOne($conectado->id_usuario);
        // }

        return $this->render('privados');
    }

    /**
    * Busca el registro del modelo Privado asociado al id pasado por parámetro.
    * Si el modelo no es encontrado se lanzará una Excepción
    * NotFoundHttpException(página no encontrada).
    * @param int $id
    * @return Privado del modelo cargado.
    * @throws NotFoundHttpException si el modelo no es encontrado.
    */
    protected function findModel($id)
    {
        if (($model = Privado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
