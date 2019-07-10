<?php


namespace App\Controller;


use App\Models\Book;
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

    public function store(ServerRequestInterface $request)
    {
        Book::create($request->getParsedBody());
    }

}