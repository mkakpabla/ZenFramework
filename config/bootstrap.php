<?php

require "../vendor/autoload.php";

use DI\ContainerBuilder;
use Framework\Router\Annotation\Reader;

$reader = new Reader('../app');
$reader->run();
$router = (new Framework\Router\Router(new \Aura\Router\RouterContainer()))
    ->addRoutes($reader->getRoutes());

$builder = new ContainerBuilder();
$builder->addDefinitions('../config/config.php');
$container = $builder->build();
$container->set('router', $router);
