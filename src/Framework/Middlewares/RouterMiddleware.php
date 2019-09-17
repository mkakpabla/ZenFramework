<?php

namespace Framework\Middlewares;

use Framework\Env;
use Framework\Router\Annotation\Reader;
use Framework\Router\Router;
use Exception;
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


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $this->getRoutes()->match($request);

        if ($route) {
            if (is_array($route->getHandler())) {
                $params = $route->getAttributes();
                $params['request'] = $request;
                $response = $this->container->call($route->getHandler(), $params);
                if ($response instanceof Response) {
                    return $response;
                }
                return new Response(200, [], $response);
            } elseif (is_callable($route->getHandler())) {
                $response =  $this->container->call($route->getHandler(), $route->getAttributes());
                return new Response(200, [], $response);
            } else {
                throw new Exception('Handler is not type array or callable');
            }
        }
        return  $handler->handle($request);
    }


    private function getRoutes()
    {
        $reader = new Reader($this->container->get('controller.path'), $this->container->get('cache.path'));
        $reader->run();
        return $this->container->get(Router::class)->addRoutes($reader->getRoutes());
    }
}
