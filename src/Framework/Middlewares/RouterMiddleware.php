<?php

namespace Framework\Middlewares;

use Exception;
use Framework\Router\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RouterMiddleware implements MiddlewareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Router
     */
    private $router;


    public function __construct(ContainerInterface $container, Router $router)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $router = $this->router;
        $route = $router->match($request);
        if ($route) {
            if (is_array($route->getHandler())) {
                $controller = ($this->container->get($route->getHandler()['controller']))
                    ->setContainer($this->container);
                $method = $route->getHandler()['method'];
                return $this->container
                    ->call([$controller, $method], array_merge(
                        $route->getAttributes(),
                        ['request' => $request]
                    ));
            } elseif (is_callable($route->getHandler())) {
                $response =  $this->container->call($route->getHandler(), array_merge(
                    $route->getAttributes(),
                    ['request' => $request]
                ));
                return new Response(200, [], $response);
            } else {
                throw new Exception('Handler is not type array or callable');
            }
        }
        return  $handler->handle($request);
    }
}
