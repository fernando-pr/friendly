<?php

$params = require(__DIR__ . '/params.php');


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@uploads' => 'uploads',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'TGDof6WNMI9Ln8SnqO0o-a9wVKRy0i7C',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'app\components\User',
            'identityClass' => 'app\models\Usuario',
            'enableAutoLogin' => false,
            'authTimeout' => 600,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => $params['smtpUsername'],
                'password' => getenv('SMTP_PASS'),
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'usuarios/view/<id:\d+>' => 'usuarios/view',
                'usuarios/update/<id:\d+>' => 'usuarios/update',
                'usuarios/<id:\d+>' => 'usuarios/view',
                'usuario/<id:\d+>' => 'usuarios/view',
                'usuarios/delete/<id:\d+>' => 'usuarios/delete',
                'usuario/delete/<id:\d+>' => 'usuarios/delete',
                'usuarios/index/<sort>' => 'usuarios/index',
                'usuarios/index/<page:\d+>/<per-page:\d+>' => 'usuarios/index',

                'amigos/solicitud/<id:\d+>' => 'amigos/solicitud',
                'amigos/cancelar/<id:\d+>' => 'amigos/cancelar',
                'amigos/aceptar/<id:\d+>' => 'amigos/aceptar',
                'amigos/borrar/<id:\d+>' => 'amigos/borrar',
                'amigos/amigos/<sort>' => 'amigos/amigos',
                'amigos/amigos/<page:\d+>/<per-page:\d+>' => 'amigos/amigos',


            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
