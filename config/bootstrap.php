<?php

require "../vendor/autoload.php";

use Aura\Router\RouterContainer;
use DI\ContainerBuilder;
use Framework\Env;
use Framework\Router\RouteExtractor;
use Framework\Router\Router;

// Recharger les variables d'environnement depuis le .env
Env::load();

// Initialisation du container
$builder = new ContainerBuilder();

// Récupération de la configuration
$config = require_once 'config.php';

$router = (new Router(
    new RouterContainer(),
    new RouteExtractor(dirname(__DIR__) . '/app/Controllers')))->extract();

// Ajout des definitions au container
$builder->addDefinitions($config);
$container = $builder->build();
$container->set(Router::class, $router);