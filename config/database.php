<?php
/**
 * Project: novel-migration
 *
 * Author: Nine
 * Date: 2018/12/13
 */

return [
    'driver' => getenv('DB_DRIVER'),
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT'),
    'user' => getenv('DB_USERNAME'),
    'password' => getenv('DB_PASSWORD'),
    'dbname' => getenv('DB_NAME'),
    'defaultDatabaseOptions' => [
        'charset' => 'utf8mb4',
        'collate' => 'utf8mb4_general_ci'
    ]
];