<?php
return [
    'dsn' => 'mysql:host=${DB_MYSQL_HOST};dbname=${DB_MYSQL_NAME}',
    'username' => '${DB_MYSQL_USER}',
    'password' => '${DB_MYSQL_PASSWORD}',
    'charset' => 'utf8mb4',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
];
