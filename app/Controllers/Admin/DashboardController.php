<?php


namespace App\Controllers\Admin;

use App\Entity\Post;
use App\Manager\PostManager;
use Framework\Controller;

class DashboardController extends Controller
{

    /**
     * @Route('get', '/admin', 'admin')
     */
    public function index()
    {
    }
}
