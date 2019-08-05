<?php


namespace App\Controllers;

use Framework\Controller;

/**
 * @BaseRoute /
 */
class HomeController extends Controller
{


    /**
     * @Route [GET] / (home)
     */
    public function index()
    {
        return $this->render('home');
    }
}
