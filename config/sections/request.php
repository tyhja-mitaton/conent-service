<?php
return [
    // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    'cookieValidationKey'  => 'eVcVeThmAes4TdBeYtKOtaq5O8tEZwrq',
    'enableCsrfValidation' => false,
    'parsers' => [
        'application/json' => 'yii\web\JsonParser',
    ]
];