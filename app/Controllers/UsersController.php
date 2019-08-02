<?php
namespace App\Controllers;

use Components\Controller;
use Psr\Http\Message\ServerRequestInterface;

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
        dd('tset');
        //
    }

    /**
     * @Route [GET] /create (users.create)
     * @return string
     */
    public function create()
    {
        return $this->render('users.create');
    }

    /**
     * @Route [POST] /store (users.store)
     * @param ServerRequestInterface $request
     * @return string
     */
    public function store(ServerRequestInterface $request)
    {
        dd($request->getParsedBody());
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
