<?php


namespace Framework\Factory;

use Framework\Env;
use PDO;
use Psr\Container\ContainerInterface;

class PdoFactory
{


    public function __invoke(ContainerInterface $container)
    {
        return new PDO(
            'mysql:host=' . $container->get('database.host') . ';dbname=' . $container->get('database.name'),
            $container->get('database.username'),
            $container->get('database.password'),
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}
