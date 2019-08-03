<?php


namespace App\Controllers;

use Components\Controller;
use Components\Renderer\RendererInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

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
