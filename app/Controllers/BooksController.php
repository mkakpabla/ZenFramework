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
        return $this->render('books.index', compact('books'));
    }

    public function show(string $slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();
        return $this->render('books.show', compact('book'));
    }


    public function create(ServerRequestInterface $request)
    {
        return $this->render('books.create');
    }

    public function store(ServerRequestInterface $request)
    {
        Book::create($request->getParsedBody());
        self::to('/books');
    }
}
