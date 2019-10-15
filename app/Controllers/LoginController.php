<?php


namespace App\Controllers;


use App\Models\User;
use Framework\AbstractController;
use GuzzleHttp\Psr7\MessageTrait;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends AbstractController
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
     * @Route('get', '/login', 'login.form')
     * @return ResponseInterface
     */
    public function loginForm()
    {
        return $this->render('login');
    }

    /**
     * @Route('post', '/login', 'login')
     * @param ServerRequestInterface $request
     * @return MessageTrait|Response
     */
    public function login(ServerRequestInterface $request)
    {
        $auth = $this->user->login($request->getParsedBody());
        if (is_null($auth)) {
            $this->addFlash('error', 'Identifient et mode passe Incorrecte');
            return $this->redirect('login');
        } else {
            return $this->redirect('account');
        }
    }
}