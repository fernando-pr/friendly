<?php

namespace app\controllers;

use Yii;
use app\models\Conectado;
use app\models\ConectadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ConectadosController implementa el CRUD y más acciones para el modelo conectados.
 */
class ConectadosController extends Controller
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
                'only' => ['create', 'update', 'view', 'delete', 'index'],
                'rules' => [
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
     * Lista todo el modelo Conectado.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConectadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un único registro del modelo Conectado.
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
     * Crea un nuevo conectado(conecta a un usuario).
     * Si el conectado es creado correctamente será redireccionado
     * al view de ese conectado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Conectado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_usuario]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica un registro del modelo conectado
     * Si la modificación es satisfactoria es redireccionado al view de ese conectado.
     * @param int $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_usuario]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Borra un registro del modelo conectado
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
    * Busca el registro del modelo conectado asociado al id pasado por parámetro.
    * Si el modelo no es encontrado se lanzará una Excepción
    * NotFoundHttpException(página no encontrada).
    * @param int $id
    * @return Conectado del modelo cargado.
    * @throws NotFoundHttpException si el modelo no es encontrado.
    */
    protected function findModel($id)
    {
        if (($model = Conectado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
