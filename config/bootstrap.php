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
    '../config/config.php',
    '../config/mail.php',
    '../config/twig.php',
    '../config/database.php'
);
$container = $builder->build();