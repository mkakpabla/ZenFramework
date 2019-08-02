<?php

namespace Components\Middlewares;

use Components\Router\Router;
use DI\Container;
use DI\ContainerBuilder;
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
     * @var Router
     */
    private $router;
    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(Router $router, ContainerInterface $container)
    {
        $this->router = $router;
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $this->router->match($request);
        if ($route) {
            if (is_array($route->getHandler())) {
                $params = $route->getAttributes();
                $params['request'] = $request;
                $response = $this->container->call($route->getHandler(), $params);
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


    /**
     * Renvoie une instance du container
     * @return Container
     * @throws Exception
     */
    private function getContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(dirname(dirname(__DIR__)) . '/config/config.php');
        $container = $builder->build();
        $container->set(Router::class, $this->router);
        return $container;
    }
}
