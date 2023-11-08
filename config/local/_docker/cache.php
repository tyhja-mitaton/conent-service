<?php
return [
    'class' => 'yii\caching\MemCache',
    'keyPrefix' => 'richy',
    'useMemcached' => true,
    'servers' => [
        [
            'host' => '${DB_MEMCACHED_HOST}',
            'port' => 11211,
        ],
    ],
];