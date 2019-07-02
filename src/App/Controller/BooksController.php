<?php


namespace App\Controller;


use Core\Components\Controller;
use Psr\Http\Message\ServerRequestInterface;

class BooksController extends Controller
{


    public function index(ServerRequestInterface $request)
    {
        return $this->renderer->render('books.index');
    }



    public function create(ServerRequestInterface $request)
    {
        return $this->renderer->render('books.create');
    }

}