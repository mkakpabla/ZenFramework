<?php

require "../vendor/autoload.php";

use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use DI\ContainerBuilder;
use function Http\Response\send;

$builder = new ContainerBuilder();
$builder->addDefinitions('../config/config.php');
$container = $builder->build();

// Création d'un application
$app = (new App($container))
    ->pipe(\Middlewares\Whoops::class)
    ->pipe(\Framework\Middlewares\TraillingSlashMiddleware::class)
    ->pipe(\Framework\Middlewares\RouterMiddleware::class)
    ->pipe(\Framework\Middlewares\NotFoundMiddleware::class)
    ->run(ServerRequest::fromGlobals());

// Affichage de la reponse
send($app);
