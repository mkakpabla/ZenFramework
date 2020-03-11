<?php

require "../vendor/autoload.php";

use Aura\Router\RouterContainer;
use DI\ContainerBuilder;
use Framework\Env;
use Framework\Router\RouteExtractor;
use Framework\Router\Router;

// Initialisation du container
$builder = new ContainerBuilder();

// Récupération de la configuration
$config = require_once 'config.php';


// Ajout des definitions au container
$builder->addDefinitions($config);
$container = $builder->build();