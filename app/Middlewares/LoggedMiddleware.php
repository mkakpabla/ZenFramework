<?php


namespace App\Middlewares;

use App\Models\User;
use Framework\ForbiddenException;
use Framework\Router\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoggedMiddleware implements MiddlewareInterface
{

    /**
     * @var User
     */
    private $user;
    /**
     * @var Router
     */
    private $router;

    public function __construct(User $user, Router $router)
    {
        $this->user = $user;
        $this->router = $router;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $user = $this->user->getUser();
        if (is_null($user)) {
            throw new ForbiddenException();
        }
        return $handler->handle($request);
    }
}
