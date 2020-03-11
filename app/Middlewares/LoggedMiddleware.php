<?php


namespace App\Middlewares;

use Framework\Router\Router;
use Framework\Security\Auth;
use Framework\ForbiddenException;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoggedMiddleware implements MiddlewareInterface
{

    /**
     * @var Auth
     */
    private $auth;
    /**
     * @var Router
     */
    private $router;

    public function __construct(Auth $auth, Router $router)
    {
        $this->auth = $auth;
        $this->router = $router;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $this->auth->getUser();
        if (is_null($user)) {
            throw new ForbiddenException();
        }
        return $handler->handle($request);
    }
}
