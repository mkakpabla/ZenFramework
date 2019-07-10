<?php
return [
    "mysql" => [
        'driver'   => 'mysql',
        'host'     => 'localhost',
        'database' => 'test',
        'username' => 'root',
        'password' => 'root',
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