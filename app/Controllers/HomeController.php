<?php


namespace App\Controllers;

use Framework\Controller;

class HomeController extends Controller
{


    /**
     * @Route('get', '/home', 'home')
     */
    public function index()
    {
        return $this->render('home');
    }
}
