<?php

use App\Middlewares\LoggedMiddleware;
use App\Modules\Auth\AuthModule;
use App\Modules\Blog\BlogModule;
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
    // Les Modules
    ->addModule(AuthModule::class)
    ->addModule(BlogModule::class)


    // Les Middleware
    ->pipe(Whoops::class)
    ->pipe(TraillingSlashMiddleware::class)
    //->pipe(ForbiddenExceptionMiddleware::class)
    ->pipe(LoggedMiddleware::class)
    ->pipe(RouterMiddleware::class)
    ->pipe(NotFoundMiddleware::class)


    ->run(ServerRequest::fromGlobals());

// Affichage de la reponse
send($app);
