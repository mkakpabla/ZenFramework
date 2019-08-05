<?php


namespace App\Controllers\Auth;

use Framework\Controller;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends Controller
{

    /**
     * @Route [GET] /login (login.create)
     * @Middleware PostMiddleware
     */
    public function createAction()
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
