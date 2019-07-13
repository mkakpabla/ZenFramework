<?php

namespace App\Controllers;

use App\Models\Book;
use Components\Controller;
use Psr\Http\Message\ServerRequestInterface;

class BooksController extends Controller
{


    public function index(ServerRequestInterface $request)
    {
        $books = Book::all();
        return $this->renderer->render('books.index', compact('books'));
    }

    public function show(ServerRequestInterface $request, $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return $this->renderer->render('books.show', compact('book'));
    }


    public function create(ServerRequestInterface $request)
    {
        return $this->renderer->render('books.create');
    }

    public function store(ServerRequestInterface $request)
    {
        Book::create($request->getParsedBody());
        self::to('/books');
    }

}