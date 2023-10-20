<?php
return [
    'class'           => 'app\components\User',
    'identityClass' => 'app\models\user\User',
    'loginUrl'        => ['/user/sign-in/login'],
    'enableAutoLogin' => true,
];