<?php

require "../vendor/autoload.php";

use Aura\Router\RouterContainer;
use DI\ContainerBuilder;
use Framework\Env;
use Framework\Router\Annotation\Reader;

// Recharger les variables d'environnement depuis le .env
Env::load();

// Lecture des routes des controllers
$reader = new Reader('../app');
$reader->run();
$router = (new Framework\Router\Router(new RouterContainer()))
    ->addRoutes($reader->getRoutes());

// Initialisation du container
$builder = new ContainerBuilder();

// Ajout des definitions au container
$builder->addDefinitions(
    '../config/config.php',
    '../config/mail.php',
    '../config/twig.php',
    '../config/database.php'
);
$container = $builder->build();

// Ajout du router au container
$container->set('router', $router);
