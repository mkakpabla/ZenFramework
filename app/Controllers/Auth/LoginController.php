<?php


namespace App\Controllers\Auth;

use Components\Controller;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @BaseRoute
 */
class LoginController extends Controller
{

    /**
     * @Route [GET] /login (login.create)
     */
    public function create()
    {
        return $this->render('auth.login');
    }

    /**
     * @Route [POST] /login (login.store)
     * @param $request
     */
    public function store(ServerRequestInterface $request)
    {
        dd($request->getParsedBody());
    }
}
