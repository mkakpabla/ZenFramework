<?php
namespace App\Controllers;

use App\Models\User;
use Framework\AbstractController;

class HomeController extends AbstractController
{


    
    /**
     * @Route('get', '/', 'home')
     */
    public function index()
    {
        return $this->render('welcome');
    }
}