<?php


return [

    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
    ],
    
    'environnements' => [
        'default_database' => 'development',
        'development' => [
            'name' => 'agence',
            'connection' => ''
        ]
    ]
];