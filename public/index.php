<?php

use Components\App;
use Components\Middlewares\NotFoundMiddleware;
use Components\Middlewares\RouterMiddleware;
use Components\Middlewares\StralingSlashMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;
use Middlewares\Whoops;

// Equire du fichier bootstrap.php
require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), "config", "bootstrap.php"]);

// Création d'un application
$app = new App([
    new Whoops(),
    new StralingSlashMiddleware(),
    new RouterMiddleware($router),
    new NotFoundMiddleware()
]);

// Execution de l'application et send
send($app->run(ServerRequest::fromGlobals()));






