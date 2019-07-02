<?php


namespace App\Controller;


use Core\Components\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{


    public function index(ServerRequestInterface $request)
    {
        return $this->renderer->render('home');
    }

}