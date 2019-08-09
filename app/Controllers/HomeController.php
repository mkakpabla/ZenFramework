<?php


namespace App\Controllers;

use Framework\Controller;

/**
 * @GroupRoute /
 */
class HomeController extends Controller
{


    /**
     * @Route('get', '/', 'home')
     */
    public function index()
    {
        return $this->render('home');
    }
}
