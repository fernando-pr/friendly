<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Clase donde añadir archivos css, javascript, dependencias, etc.
 *
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/login.css',
        'css/index.css',
        'css/chatpublico.css',
    ];
    public $js = [
        'js/login.js',
        'js/index.js',
        'js/jquery.galeria.js',
        'js/jquery.reproductor.js',
        'js/validacion.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
