<?php

use Dotenv\Dotenv;

require __DIR__. '/vendor/autoload.php';

$env = __DIR__. '/.env';

if(file_exists($env)) {
    // Initialisation du .env
    $dotenv = Dotenv::create(__DIR__);
    $dotenv->load();
}

if(getenv('APP_ENV') == "development"){
    $database_default = "development";
}elseif(getenv('APP_ENV') == "production"){
    $database_default = "production";
}

return [
    'paths' => [
        'migrations' => __DIR__ . '/app/Database/Migrations',
        'seeds' => __DIR__ . '/app/Database/Seeds'
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
