<?php


namespace App\Controllers;


use App\Models\User;
use Framework\AbstractController;
use Framework\Middlewares\UserLoggedMiddleware;
use Psr\Http\Message\ResponseInterface;

class AccountController extends AbstractController
{

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @Route('get', '/account', 'account')
     * @return ResponseInterface
     */
    public function index()
    {
        $user = $this->user->getUser();
        return $this->render('account', compact('user'));
    }

}