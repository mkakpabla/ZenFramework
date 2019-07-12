<?php


use Components\Router\Router;

$router = new Router();

$router->get('/', '\App\Controllers\HomeController#index', 'home');
$router->get('/books', '\App\Controllers\BooksController#index', 'books');
$router->get('/books/create', '\App\Controllers\BooksController#create', 'books.create');
$router->post('/books/store', '\App\Controllers\BooksController#store', 'books.store');