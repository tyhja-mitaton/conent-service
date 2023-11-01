<?php
return [
    'user' => [
        'class' => 'app\modules\user\Module',
        'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['administrator'],
                ],
            ],
        ],
    ],
    'admin' => [
        'class' => 'app\modules\admin\Module',
        'as access' => [
            'class' => 'yii\filters\AccessControl',
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['administrator'],
                ],
            ],
        ],
    ],
];