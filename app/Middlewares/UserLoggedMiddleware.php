<?php


namespace App\Middlewares;


use App\Models\User;
use Framework\ForbiddenException;
use Framework\Router\RouterInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UserLoggedMiddleware implements MiddlewareInterface
{

    /**
     * @var User
     */
    private $user;

    private $routes = [
        'account'
    ];
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(User $user, ContainerInterface $container)
    {
        $this->user = $user;
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $router = $this->container->get('router');
        $route = $router->match($request);
        $user = $this->user->getUser();
        if (is_null($user) && in_array($route->getName(), $this->routes)) {
            throw new ForbiddenException();
        }
        return $handler->handle($request);
    }
}