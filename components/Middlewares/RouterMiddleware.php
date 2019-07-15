<?php

namespace Components\Middlewares;

use Components\Router\Route;
use Components\Router\Router;
use DI\ContainerBuilder;
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

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $this->router->match($request);
        if ($route) {
            if (is_array($route->getHandler())) {

                $response = $this->getContainer()->call($route->getHandler());
                return new Response(200, [], $response);
            }
            $response =  call_user_func_array($route->getHandler(), [$request, $route->getAttributes()]);
            return new Response(200, [], $response);
        }
        return  $handler->handle($request);
    }


    private function getContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(dirname(dirname(__DIR__)) . '/config/config.php');
        $this->container = $builder->build();
        $this->container->set(Router::class, $this->router);
        return $this->container;
    }
}