<?php

namespace App\Modules\Auth\Actions;

use Framework\AbstractAction;
use Psr\Http\Message\ResponseInterface;

class RegisterAction extends AbstractAction
{
    /**
     * @Route('get', '/register', 'register.form')
     * @return ResponseInterface
     */
    public function registerForm()
    {
        return $this->render('users.register');
    }

    /**
     * @Route('post', '/register', 'register')
     * @return ResponseInterface
     */
    public function register()
    {
        return $this->render('users.register');
    }

}