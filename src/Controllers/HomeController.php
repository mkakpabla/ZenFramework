<?php


namespace App\Controllers;


use Components\Controller;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends Controller
{


    public function index(ServerRequestInterface $request)
    {
        return 'welcome';
    }

}