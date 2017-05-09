<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
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

            $dataProvider = new ActiveDataProvider([
                'query' => Usuario::find()->orWhere(['ilike', 'nombre', $q])
                                          ->orWhere(['ilike', 'poblacion', $q])
                                          ->orWhere(['ilike', 'provincia', $q]),
                'pagination' => false,
                'sort' => false,
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Usuario::find()->where(['ilike', $cond, $q]),
                'pagination' => false,
                'sort' => false,
            ]);
        }


        // $dataProvider = new ActiveDataProvider([
        //     'query' => Usuario::find()->where(['ilike', 'nombre', $q]),
        //     'pagination' => false,
        //     'sort' => false,
        // ]);


        return $this->renderAjax('/site/_usuarios', [
            'dataProvider' => $dataProvider,
        ]);
    }
}
