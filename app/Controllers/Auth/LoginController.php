<?php


namespace App\Controllers\Auth;

use App\Entity\User;
use Framework\Controller;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends Controller
{

    /**
     * @var User
     */
    private $user;

    public function __construct(ContainerInterface $container, User $user)
    {
        parent::__construct($container);
        $this->user = $user;
    }

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
