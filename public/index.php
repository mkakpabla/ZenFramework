<?php

use Core\App;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;


require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), "src", "bootstrap.php"]);




$app = new App([
    new \Middlewares\Whoops(),
    new \App\Middlewares\RouterMiddleware($router),
    new \App\Middlewares\NotFoundMiddleware()
]);
$response = $app->run(ServerRequest::fromGlobals());

send($response);






