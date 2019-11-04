<?php

require "../vendor/autoload.php";

use DI\ContainerBuilder;
use Framework\Env;

// Recharger les variables d'environnement depuis le .env
Env::load();

// Initialisation du container
$builder = new ContainerBuilder();

// Ajout des definitions au container
$builder->addDefinitions(
    '../config/app.config.php',
    '../config/mail.config.php',
    '../config/twig.config.php',
    '../config/database.config.php'
);
$container = $builder->build();