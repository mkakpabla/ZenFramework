<?php
namespace App\Controllers;

use App\Models\User;
use Framework\AbstractController;

class HomeController extends AbstractController
{


    
    /**
     * @Route('get', '/', 'home')
     */
    public function index(User $user)
    {
        return $this->render('welcome');
    }
}