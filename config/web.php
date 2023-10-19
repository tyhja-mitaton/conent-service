<?php
require 'common.php';

$config = [
    //'modules' => null,
    'components' => [
        'errorHandler' => [
            'class' => 'app\components\ErrorHandlerWeb',
        ],
        'user' => null,
        'request' => null,
        'response' => null,
        'assetManager' => null,
        'authClientCollection' => null,
    ],
    //'defaultRoute' => '/user/default/route',
    //'container' => null,
];

if (env('YII_DEBUG')) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '172.*.0.*', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '172.*.0.*', '::1'],
    ];
}


return (new ConfigGenerator($config))->getFullConfig();
