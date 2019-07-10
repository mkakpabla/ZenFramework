<?php
require_once 'env.php';
$database  =  [
    "mysql" => [
        'driver'   => 'mysql',
        'host'     => getenv('DB_HOST'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'   => '',
    ],

    "pgsql" => [
        'driver'   => 'pdo_pgsql',
        'host'     => 'localhost',
        'charset'  => 'utf8',
        'user'     => 'root',
        'password' => '',
        'dbname'   => 'poll',
    ],
    
    "sqlite" => [
        'driver'   => 'pdo_sqlite',
        'path'   => 'data/poll.sqlite'
    ]
];

return $database['mysql'];