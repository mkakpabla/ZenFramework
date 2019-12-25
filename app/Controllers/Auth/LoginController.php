<?php


namespace App\Controllers\Auth;


use Framework\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends AbstractController
{
    /**
     * @Route('get', '/login', 'loginForm')
     * @return ResponseInterface
     */
    public function loginForm()
    {
        return $this->render('users.login');
    }

    /**
     * @Route('post', '/login', 'login')
     * @param ServerRequestInterface $request
     */
    public function login(ServerRequestInterface $request)
    {
        dd($request->getParsedBody());
    }
}