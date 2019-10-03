<?php
use Framework\App;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;

require '../config/bootstrap.php';

// Création d'un application
$app = (new App($container))
    ->pipe(\Middlewares\Whoops::class)
    ->pipe(\Framework\Middlewares\TraillingSlashMiddleware::class)
    ->pipe(\Framework\Middlewares\RouterMiddleware::class)
    ->pipe(\Framework\Middlewares\NotFoundMiddleware::class)
    ->run(ServerRequest::fromGlobals());

// Affichage de la reponse
send($app);
