<?php

namespace app\controllers;

use Yii;
use app\helpers\Mensaje;
use app\models\Usuario;
use app\models\Amigo;
use app\models\UsuarioSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

/**
* UsuariosController implementa el CRUD y más acciones para el modelo Usuario.
*/
class UsuariosController extends Controller
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
                        'actions' => ['delete'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $id = Yii::$app->request->get('id');
                            return Yii::$app->user->id == $id;
                        }
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
     * Lista todo el modelo Usuario.
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
     * Muestra un único registro del modelo Usuario.
     * @param int $id
     * @return mixed
     */
    public function actionView($id = null)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Devuelve las peticiones recibidas por el usuario.
     * @return mixed.
     */
    public function actionPeticiones()
    {

        $usuario = new Usuario();

        $peticiones = $usuario->getPeticiones();

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

    /**
     * Activa un usuario registrado para que pase a ser un usuario validado.
     * @param  string  $token token que recibe el usuario
     *  en su correo para activas su usuario.
     * @return string       redirecciona a la pantalla de login.
     */
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
     * Crea un nuevo registro del modelo Usuario
     * Si el Usuario es creado correctamente será redireccionado
     * al view de ese Usuario.
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

                Mensaje::info('Se ha registrado en friendly. Por favor revise su correo para ser activado <br>
                <div class="usuario-view">
                     <button type="button" class="btn btn-warning btn-lg boton_ok">Entendido</button>
                </div>');
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
     * Modifica un registro del modelo Usuario
     * Si la modificación es satisfactoria es redireccionado al view de ese Usuario.
     * @param int $id
     * @return mixed
     */
    public function actionUpdate($id = null)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->provincia != '' && $model->poblacion != '') {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            } else {
                $model->provincia = Yii::$app->user->identity->provincia;
                $model->poblacion = Yii::$app->user->identity->poblacion;
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Borra un registro del modelo Usuario
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
    * Busca el registro del modelo Usuario asociado al id pasado por parámetro.
    * Si el modelo no es encontrado se lanzará una Excepción
    * NotFoundHttpException(página no encontrada).
    * @param int $id
    * @return Usuario del modelo cargado.
    * @throws NotFoundHttpException si el modelo no es encontrado.
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
