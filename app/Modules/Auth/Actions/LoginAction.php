<?php


namespace App\Modules\Auth\Actions;


use Framework\AbstractAction;
use Psr\Http\Message\ResponseInterface;

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
     * @return ResponseInterface
     */
    public function login()
    {
        return $this->render('users.login');
    }
}