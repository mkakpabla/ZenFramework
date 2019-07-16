<?php

namespace Components\Middlewares;

use Components\Router\Router;
use DI\Container;
use DI\ContainerBuilder;
use Exception;
use GuzzleHttp\Psr7\Response;
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
     * @throws Exception
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $this->router->match($request);
        if ($route) {
            if (is_array($route->getHandler())) {
                $response = $this->getContainer()->call($route->getHandler(), $route->getAttributes());
                return new Response(200, [], $response);
            } elseif (is_callable($route->getHandler())) {
                $response =  $this->getContainer()->call($route->getHandler(), $route->getAttributes());
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
