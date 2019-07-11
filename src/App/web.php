<?php

use Core\Router\Router;

$router = new Router();

$router->get('/', '\App\Controller\HomeController#index', 'home');
$router->get('/books', '\App\Controller\BooksController#index', 'books');
$router->get('/books/create', '\App\Controller\BooksController#create', 'books.create');
$router->post('/books/store', '\App\Controller\BooksController#store', 'books.store');