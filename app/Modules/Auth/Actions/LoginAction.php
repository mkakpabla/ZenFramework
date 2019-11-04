<?php


namespace App\Modules\Auth\Actions;

use App\Models\User;
use Framework\AbstractAction;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginAction extends AbstractAction
{

    /**
     * @Route('get', '/login', 'login.form')
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
     * @return ResponseInterface
     */
    public function login(ServerRequestInterface $request, User $user)
    {
        $user->login($request->getParsedBody());
        return $this->render('users.login');
    }
}
