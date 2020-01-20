<?php
namespace App\Controllers;

use App\Models\User;
use Framework\AbstractController;

class HomeController extends AbstractController
{


    public function __construct(User $user)
    {
        
    }

    /**
     * @Route('get', '/', 'home')
     */
    public function index()
    {
        return $this->render('welcome');
    }
}