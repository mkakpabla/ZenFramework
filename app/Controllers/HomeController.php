<?php


namespace App\Controllers;


use Components\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController extends Controller
{


    public function index(Request $request)
    {
        return $this->render('home.twig');
    }

}