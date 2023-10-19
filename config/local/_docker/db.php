<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.env('DB_MYSQL_HOST').';dbname='.env('DB_MYSQL_DATABASE_NAME'),
    'username' => env('DB_MYSQL_USER'),
    'password' => env('DB_MYSQL_PASSWORD'),
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 3600,
    //'schemaCache' => 'cache',
];
