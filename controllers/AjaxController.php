<?php

namespace app\controllers;

use app\models\Privado;
use app\models\Publico;
use app\models\Conectado;
use yii\filters\VerbFilter;
use Yii;
use app\models\Usuario;

class AjaxController extends \yii\web\Controller
{
    /**
    * @inheritdoc
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

    public function actionIndex()
    {
        return $this->render('index');
    }

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



    public function actionPublicosmsg()
    {
        $model = Publico::find()->all();


        return $this->renderAjax('/publicos/_mensajesgrupo', [
            'model' => $model,
        ]);
    }

    public function actionPrivadosmsg($id_amigo)
    {

        $privado = new Privado();
        $model = $privado->getMensajesUsuario($id_amigo);
        

        return $this->renderAjax('/privados/_mensajesprivados', [
            'model' => $model,
        ]);
    }

}
