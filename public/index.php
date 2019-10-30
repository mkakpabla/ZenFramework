<?php

use App\Middlewares\UserLoggedMiddleware;
use Framework\App;
use Framework\Middlewares\ForbiddenExceptionMiddleware;
use Framework\Middlewares\NotFoundMiddleware;
use Framework\Middlewares\RouterMiddleware;
use Framework\Middlewares\TraillingSlashMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use Middlewares\Whoops;
use function Http\Response\send;

require '../config/bootstrap.php';


// Création d'un application
$app = (new App($container))
    ->addModule(\App\Modules\Auth\AuthModule::class)
    ->addModule(\App\Modules\Blog\BlogModule::class)


    ->pipe(Whoops::class)
    ->pipe(TraillingSlashMiddleware::class)
    //->pipe(ForbiddenExceptionMiddleware::class)
    ->pipe(RouterMiddleware::class)
    //->pipe(UserLoggedMiddleware::class)
    ->pipe(NotFoundMiddleware::class)


    ->run(ServerRequest::fromGlobals());

// Affichage de la reponse
send($app);
