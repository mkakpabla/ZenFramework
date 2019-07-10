<?php

use Core\Router;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

require "../vendor/autoload.php";

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();

require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), "src", "bootstrap.php"]);

$router = new Router(ServerRequest::fromGlobals());



$router->get('/', '\App\Controller\HomeController#index', 'home');
$router->get('/books', '\App\Controller\BooksController#index', 'books');
$router->get('/books/create', '\App\Controller\BooksController#create', 'books.create');

$response = $router->run();

send($response);


