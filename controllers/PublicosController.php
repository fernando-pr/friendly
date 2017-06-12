<?php

namespace app\controllers;

use Yii;
use app\models\Usuario;
use app\models\Publico;
use app\models\Conectado;
use app\models\PublicoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
* PublicosController implementa el CRUD y más acciones para el modelo Publico.
*/
class PublicosController extends Controller
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
                'only' => ['create', 'update', 'view', 'delete', 'index', 'publicos'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'update', 'view', 'delete', 'index', 'publicos'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->esAdmin;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['publicos'],
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
     * Lista todo el modelo Publico.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Renderiza la vista publicos
     * @return mixed
     */
    public function actionPublicos()
    {
        $id = Yii::$app->user->id;
        $comprobar = Conectado::findOne(['id_usuario' => $id]);
        if (!isset($comprobar)) {
            $conectado = new Conectado();
            $conectado->id_usuario = $id;
            $conectado->save();
        }

        return $this->render('publicos');
    }

    /**
     * Muestra un único registro del modelo Publico.
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
     * Crea un nuevo registro del modelo Publico
     * Si el mensaje Publico es creado correctamente será redireccionado
     * al view de ese Publico.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publico();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Este metodo envia un mensaje pasado por parametro al chat de grupo.
     *
     * @param  string  $mensaje  mensaje a enviar
     *
     */
    public function actionEnviar($mensaje)
    {
        if ($mensaje != null || $mensaje != '') {
            $model = new Publico();
            $model->id_usuario = Yii::$app->user->id;
            $model->mensaje = $mensaje;

            $model->load(Yii::$app->request->post());
            $model->save();
        }
    }



    /**
     * Modifica un registro del modelo Publico
     * Si la modificación es satisfactoria es redireccionado al view de ese Publico.
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
     * Borra un registro del modelo Publico
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
    * Busca el registro del modelo Publico asociado al id pasado por parámetro.
    * Si el modelo no es encontrado se lanzará una Excepción
    * NotFoundHttpException(página no encontrada).
    * @param int $id
    * @return Publico del modelo cargado.
    * @throws NotFoundHttpException si el modelo no es encontrado.
    */
    protected function findModel($id)
    {
        if (($model = Publico::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
