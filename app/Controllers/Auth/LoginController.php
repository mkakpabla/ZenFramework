<?php


namespace App\Controllers\Auth;

use Framework\Controller;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends Controller
{

    /**
     * @Route('get', '/users/create', 'login.create')
     * @Middleware PostMiddleware
     */
    public function create()
    {
        return $this->render('auth.login');
    }

    /**
     * @Route('post', '/users/store', 'login.store')
     * @param $request
     */
    public function store(ServerRequestInterface $request)
    {
        dd($request->getParsedBody());
    }
}
