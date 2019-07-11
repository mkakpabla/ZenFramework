<?php
use Core\Components\Database;

$config  =  require implode(DIRECTORY_SEPARATOR, ['config', 'database.php']);
$database = new Database($config);

return [

    'paths' => [
        'migrations' => __DIR__ . '/database/migrations',
        'seeds' => __DIR__ . '/database/seeds'
    ],
    
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'development',
        'development' => [
            'name' => 'development',
            'connection' => $database->getPDO()
        ]
    ]
];