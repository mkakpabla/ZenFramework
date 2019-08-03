<?php
namespace App\Controllers;

use Components\Controller;

/**
 * @BaseRoute /users
 */
class UsersController extends Controller
{


    /**
     * @Route [GET] / (users.index)
     * @return string
     */
    public function index()
    {
        //
    }



    /**
     * @Route [GET] /{id} (users.show)
     * @param $id
     * @return string
     */
    public function show($id)
    {
        //
    }
}
