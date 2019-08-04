<?php

require "../vendor/autoload.php";

use Components\App;
use Components\Middlewares\NotFoundMiddleware;
use Components\Middlewares\RouterMiddleware;
use Components\Middlewares\TraillingSlashMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;
use Middlewares\Whoops;

// Création d'un application
$app = (new App())
    ->pipe(Whoops::class)
    ->pipe(TraillingSlashMiddleware::class)
    ->pipe(RouterMiddleware::class)
    ->pipe(NotFoundMiddleware::class)
    ->run(ServerRequest::fromGlobals());

// Affichage de la reponse
send($app);
