<?php


namespace App\Middlewares;


use Core\Router\Router;
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
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $route = $this->router->match($request);
        if (!$route) {
            return  $handler->handle($request);
        } else {
            if (is_callable($route->getHandler())) {
                $response =  call_user_func_array($route->getHandler(), [$request]);
                return new Response(200, [], $response);
            } elseif (is_string($route->getHandler())) {
                $target = explode('#', $route->getHandler());
                $controller = new $target[0]();
                $action = $target[1];
                $response = $controller->$action($request);
                return new Response(200, [], $response);
            }
        }
    }
}