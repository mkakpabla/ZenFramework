<?php


namespace App\Controllers\Admin;

use Framework\Controller;

class DashboardController extends Controller
{

    /**
     * @Route('get', '/admin', 'admin')
     */
    public function index()
    {
        return $this->render('admin.index');
    }
}
