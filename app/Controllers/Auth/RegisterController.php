<?php


namespace App\Controllers\Auth;

use App\Entity\User;
use App\Manager\UserManager;
use Framework\Controller;
use Psr\Http\Message\ServerRequestInterface;

/**
 * @BaseRoute
 */
class RegisterController extends Controller
{

    /**
     * @Route [GET] /register (register.create)
     */
    public function create()
    {
        return $this->render('auth.register');
    }

    /**
     * @Route [POST] /register (register.store)
     * @param ServerRequestInterface $request
     * @return string
     */
    public function store(ServerRequestInterface $request)
    {
        $data = $request->getParsedBody();
        $user = new User();
        $user->setUsername($data['username'])
            ->setEmail($data['email'])
            ->setPassword(sha1($data['password']));
        $this->container->get(UserManager::class)->create($user);
        return $this->redirect('login.create');
    }
}
