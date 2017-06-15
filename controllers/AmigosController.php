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
* AmigosController implementa el CRUD y más acciones para el modelo amigos.
*/
class AmigosController extends Controller
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
    * Lista todo el modelo amigo.
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
    * Muestra un amigo cuyo id es pasado por parámetro.
    * @param int $id    id del amigo
    * @return mixed
    */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
    * Crea un nuevo amigo.
    * Si el amigo es creado correctamente será redireccionado al view de ese amigo.
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
    * Modifica un amigo ya existente.
    * Si la modificación es satisfactoria es redireccionado al view de ese amigo.
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
    * Borra el amigo que coincida con el id parado por parámetro.
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
    * Busca el amigo asociado al id pasado por parámetro.
    * Si el model no es encontrado se lanzará una Excepción
    * NotFoundHttpException(página no encontrada).
    * @param int $id
    * @return Amigo del modelo cargado.
    * @throws NotFoundHttpException si el modelo no es encontrado.
    */
    protected function findModel($id)
    {
        if (($model = Amigo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('La página solicitada no existe');
        }
    }

    /**
    * Manda una solicitud de amistad al usuario indicado por parámetro.
    * @param  int  $id      id del usuario que queremos mandar petición.
    * @param  string  $redirect url a la que hay que redireccionar la página.
    * @return mixed
    */
    public function actionSolicitud($id, $redirect = null)
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
        if ($redirect != null) {
            return $this->goBack();
        }
    }

    /**
     * Cancela la solicitud de amistad en el caso que todavía no
     * haya sido aceptada por el otro usuario.
     *
     * @param  int  $id      id del usuario que queremos cancelar la petición.
     * @param  string  $redirect url a la que hay que redireccionar la página.
     * @return mixed
     */
    public function actionCancelar($id, $redirect = null)
    {
        $amigo = new Amigo();
        $existePeticion = $amigo->estaPeticionEnviada($id);

        if ($existePeticion) {
            $cond = ['id_usuario' => Yii::$app->user->id, 'id_amigo' => $id];
            $model = Amigo::findOne($cond);
            $model->delete();
        }

        if ($redirect != null) {
            return $this->goBack();
        }
    }

    /**
     * Acepta la solicitud de amistad recibida por otro usuario.
     *
     * @param  int  $id     id del usuario que envia la solicitud.
     * @return mixed
     */
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

    /**
     * Rechaza la solicitud de amistad recibida por otro usuario.
     *
     * @param  int  $id     id del usuario que envia la solicitud.
     * @return mixed
     */
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

    /**
     * Borra a un amigo pasado por parámetro (borra la amistad).
     *
     * @param  int  $id     id del usuario que es amigo del usuario logueado.
     * @return mixed
     */
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
        //return $this->goBack();
    }
}
