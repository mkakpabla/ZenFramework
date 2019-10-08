<?php

require "../vendor/autoload.php";

use Aura\Router\RouterContainer;
use DI\ContainerBuilder;
use Framework\Env;
use Framework\Router\Annotation\Reader;

Env::load();
$reader = new Reader('../app');
$reader->run();
$router = (new Framework\Router\Router(new RouterContainer()))
    ->addRoutes($reader->getRoutes());

$builder = new ContainerBuilder();
$builder->addDefinitions(
    '../config/config.php',
    '../config/mail.php',
    '../config/twig.php',
    '../config/database.php'
);
$container = $builder->build();
$container->set('router', $router);
