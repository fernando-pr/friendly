<?php

namespace app\controllers;

use Yii;
use app\models\Estado;
use app\models\EstadoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EstadosController implementa el CRUD y más acciones para el modelo Estado.
 */
class EstadosController extends Controller
{
    /**
     * Define el comportamiento y el control de acceso a los componentes.
     * @return mixed
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lista todo el modelo Estado.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstadoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un único registro del modelo Estado.
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
     * Crea un nuevo registro del modelo Estado
     * Si el Estado es creado correctamente será redireccionado
     * al view de ese Estado.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estado();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Modifica un registro del modelo Estado
     * Si la modificación es satisfactoria es redireccionado al view de ese conectado.
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
      * Borra un registro del modelo Estado
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
    * Busca el registro del modelo Estado asociado al id pasado por parámetro.
    * Si el modelo no es encontrado se lanzará una Excepción
    * NotFoundHttpException(página no encontrada).
    * @param int $id
    * @return Estado del modelo cargado.
    * @throws NotFoundHttpException si el modelo no es encontrado.
    */
    protected function findModel($id)
    {
        if (($model = Estado::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
