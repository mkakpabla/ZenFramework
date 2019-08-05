<?php

use Framework\Env;

include __DIR__. '/vendor/autoload.php';
Env::load();
if (getenv('APP_ENV') == "development") {
    $database_default = "development";
} elseif (getenv('APP_ENV') == "production") {
    $database_default = "production";
}

return [
    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
    ],
    'environments' => [
        'default_database' => $database_default,
        'development' => [
            'adapter' => getenv('DB_CONNECTION'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_DATABASE'),
            'user' => getenv('DB_USERNAME'),
            'pass' => getenv('DB_PASSWORD')
        ],
        'production' => [
            'adapter' => getenv('DB_CONNECTION'),
            'host' => getenv('DB_HOST'),
            'name' => getenv('DB_DATABASE'),
            'user' => getenv('DB_USERNAME'),
            'pass' => getenv('DB_PASSWORD')
        ]
    ]
];
