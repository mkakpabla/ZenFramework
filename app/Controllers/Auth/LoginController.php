<?php


namespace App\Controllers\Auth;


use App\Models\User;
use Framework\Security\Auth;
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
        $auth = $this->auth()->login($credentials);
        if($auth->getUser()) {
            return $this->redirect('home');
        } else {
            $this->addFlash('error', 'Identifiant ou mot de passe incorrecte');
            return $this->redirect('loginForm');
        }
    }

    /**
     * @Route('get', '/logout', 'logout')
     * @param ServerRequestInterface $request
     * @param User $user
     */
    public function logout()
    {
        $this->auth()->logout();
        return $this->redirect('loginForm');
    }
}