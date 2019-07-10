<?php
use Core\Components\Database;

$config  =  require implode(DIRECTORY_SEPARATOR, ['config', 'database.php']);
$database = new Database($config);

return [

    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
    ],
    
    'environnements' => [
        'default_database' => 'development',
        'development' => [
            'name' => $config['database'],
            'connection' => $database->getPDO()
        ]
    ]
];