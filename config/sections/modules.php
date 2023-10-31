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
];