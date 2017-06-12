<?php

namespace app\controllers;

use app\models\Privado;
use app\models\Publico;
use app\models\Conectado;
use yii\filters\VerbFilter;
use Yii;
use app\models\Usuario;

/**
* AjaxController, controlador que se encarga de todas las acciones que
* tienen que var con la tecnología ajax.
*/
class AjaxController extends \yii\web\Controller
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
                    'ajax' => ['POST'],
                ],
            ],
        ];
    }

    /**
    * Renderiza la vista raiz(index) de la aplicación.
    * @return mixed
    */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
    * Método que se encarga de buscar los usuarios que coincidan
    * con el parámetro $q y cumplan la condición de $cond.
    * @param  string  $q    cadena a buscar entre los usuarios.
    * @param  string  $cond condición para buscar por nombre,
    *         población, provincia o todos.
    * @return mixed
    */
    public function actionBuscar($q, $cond)
    {
        if ($cond == 'todos') {
            $model = Usuario::find()->orWhere(['ilike', 'nombre', $q])
            ->orWhere(['ilike', 'poblacion', $q])
            ->orWhere(['ilike', 'provincia', $q])
            ->andWhere('activacion is null')
            ->all();
        } else {
            $model = Usuario::find()->where(['ilike', $cond, $q])->andWhere('activacion is null')->all();
        }

        return $this->renderAjax('/site/_usuarios', [
            'model' => $model,
        ]);
    }

    /**
    * Muestra los usuarios que estan conectados en ese momento.
    * @return mixed
    */
    public function actionConectados()
    {
        $conectados = Conectado::find()->all();
        $model=[];
        foreach ($conectados as $conectado) {
            $model[] = Usuario::findOne($conectado->id_usuario);
        }

        return $this->renderAjax('/publicos/_conectados', [
            'model' => $model,
        ]);
    }


    /**
     * coge la cookie y la guarda en la base de datos.
     * @param  int  $valor valor de la cookie
     * @return void
     */
    public function actionActualizar($valor)
    {
        $cookie = $_COOKIE['conexion'];

        if (isset($cookie)) {
            $conectado = Conectado::findOne(Yii::$app->user->id);
            if (isset($conectado)) {
                $conectado->cookie = $cookie;
                $conectado->update();
            }
        }
    }
    /**
    * Muestra los usuarios que estan conectados en ese momento y que además
    * son amigos del usuario logueado.
    * @return mixed
    */
    public function actionAmigosconectados()
    {
        $conectados = Conectado::find()->all();
        $model=[];
        foreach ($conectados as $conectado) {
            $usr = Usuario::findOne($conectado->id_usuario);
            if (Yii::$app->user->getEsMiAmigo($conectado->id_usuario)) {
                $model[] =$usr;
            }
        }

        return $this->renderAjax('/privados/_conectados', [
            'model' => $model,
        ]);
    }


    /**
    * Muestra los mensajes que están enviados en el chat de grupo.
    * @return mixed
    */
    public function actionPublicosmsg()
    {
        $model = Publico::find()->limit(50)->orderBy('id DESC')->all();
        $model = array_reverse($model);
        return $this->renderAjax('/publicos/_mensajesgrupo', [
            'model' => $model,
        ]);
    }

    /**
    * Muestra los mensajes que están enviados en el chat privado entre el
    * usuario logueado y el usuario cuyo id sea $id_amigo.
    * @param  int  $id_amigo id del amigo del usuario logueado
    * @return mixed
    */
    public function actionPrivadosmsg($id_amigo)
    {

        $privado = new Privado();
        $model = $privado->getMensajesUsuario($id_amigo);
        $model = array_reverse($model);

        return $this->renderAjax('/privados/_mensajesprivados', [
            'model' => $model,
        ]);
    }


    /**
    * Devuelve el nombre del usuario cuyo id sea $id_amigo.
    * @param  int  $id_amigo    id del usuario que queremos el nombre
    * @return string
    */
    public function actionNombre($id_amigo)
    {

        $usuario = new Usuario();

        return $usuario->findOne($id_amigo)->nombre;
    }
}
