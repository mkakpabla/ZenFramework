<?php

use Core\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use function Http\Response\send;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;


require implode(DIRECTORY_SEPARATOR, [dirname(__DIR__), "src", "bootstrap.php"]);

$whoops = new Run;
$whoops->pushHandler(new PrettyPageHandler);
$whoops->register();


$router = new Router();


$router->get('/', '\App\Controller\HomeController#index', 'home');
$router->get('/books', '\App\Controller\BooksController#index', 'books');
$router->get('/books/create', '\App\Controller\BooksController#create', 'books.create');
$router->post('/books/store', '\App\Controller\BooksController#store', 'books.store');

$response = $router->run(ServerRequest::fromGlobals());

send($response);


