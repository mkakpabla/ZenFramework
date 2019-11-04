<?php
return [

    'database' => [
        'host'      => getenv('DB_HOST') ?: 'localhost',
        'name'      => getenv('DB_DATABASE') ?: 'zen',
        'username'  => getenv('DB_USERNAME') ?: 'root',
        'password'  => getenv('DB_PASSWORD') ?: 'root',
    ],
];