<?php


namespace App\Controllers\Auth;


use App\Models\User;
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
     * @param User $user
     */
    public function login(ServerRequestInterface $request)
    {
        $credentials = $request->getParsedBody();
        $this->container->get(User::class)->all();
    }
}