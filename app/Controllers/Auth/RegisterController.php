<?php


namespace App\Controllers\Auth;


use App\Models\User;
use Framework\AbstractController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RegisterController extends AbstractController
{

    /**
     * @Route('get', '/register', 'registerForm')
     * @return ResponseInterface
     */
    public function registerForm()
    {
        return $this->render('users.register');
    }

    /**
     * @Route('post', '/register', 'register')
     * @param ServerRequestInterface $request
     * @param User $user
     * @return ResponseInterface
     */
    public function register(ServerRequestInterface $request, User $user)
    {
        $user->validate($request);
        dd($user->all());
    }

}