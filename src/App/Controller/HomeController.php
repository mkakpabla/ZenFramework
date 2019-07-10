<?php


namespace App\Controller;


use App\Models\Book;
use Core\Components\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{


    public function index(ServerRequestInterface $request)
    {
        $books = Book::all();
        dd($books);
        return $this->renderer->render('home');
    }

}