<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;

/**
 * Este comando muestra la cadena pasada como parámetro.
 *
 * Este comando es un ejamplo para hacer más comandos.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{
    /**
     * This command muestra el mensaje que quieras.
     * @param string $message mensaje que quieres mostrar.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }
}
