<?php


namespace Framework\Factory;

use PDO;
use Psr\Container\ContainerInterface;

class PdoFactory
{


    public function __invoke(ContainerInterface $container)
    {
        $database = (object)$container->get('database');
        return new PDO(
            'mysql:host=' . $database->host . ';dbname=' . $database->name,
            $database->username,
            $database->password,
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}
