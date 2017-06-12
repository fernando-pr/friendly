<?php
/**
* @link http://www.yiiframework.com/
* @copyright Copyright (c) 2008 Yii Software LLC
* @license http://www.yiiframework.com/license/
*/

namespace app\commands;

use app\models\Conectado;
use yii\console\Controller;

/**
* Este comando muestra la cadena pasada como parámetro.
*
* Este comando es un ejamplo para hacer más comandos.
*
* @author Qiang Xue <qiang.xue@gmail.com>
* @since 2.0
*/
class ConectadosController extends Controller
{
    /**
    * This command borra los usuarios que estan más de 10 min inactividad.
    */
    public function actionIndex()
    {
        $time = time();
        echo Conectado::deleteAll(['>', '(' . $time . '-cookie)', '600']);
    }
}
