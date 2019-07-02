<?php


namespace Core;


use Aura\Router\RouterContainer;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    private $routerContainer;
    /**
     * @var ServerRequestInterface
     */
    private $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->routerContainer = new RouterContainer();
        $this->request = $request;
    }

    public function get(string $uri, $callable, string $name)
    {
        $this->routerContainer->getMap()->get($name, $uri, $callable);
    }

    public function run()
    {

        $matcher = $this->routerContainer->getMatcher();
        $route = $matcher->match($this->request);
        if (!$route) {
            // get the first of the best-available non-matched routes
            $failedRoute = $matcher->getFailedRoute();
            // which matching rule failed?
            switch ($failedRoute->failedRule) {
                case 'Aura\Router\Rule\Allows':
                    return new Response(405);
                    // 405 METHOD NOT ALLOWED
                    // Send the $failedRoute->allows as 'Allow:'
                    break;
                case 'Aura\Router\Rule\Accepts':
                    // 406 NOT ACCEPTABLE
                    return new Response(406);
                    break;
                default:
                    // 404 NOT FOUND
                    return new Response(404, [], '<h1>404 Not Found</h1>');
                    break;
            }
        } else {
            if (is_callable($route->handler)) {
                $response =  call_user_func_array($route->handler, [$this->request]);
                return new Response(200, [], $response);
            } elseif (is_string($route->handler)) {
                $target = explode('#', $route->handler);
                $controller = new $target[0]();
                $action = $target[1];
                $response = $controller->$action($this->request);
                return new Response(200, [], $response);
            }
        }
    }
}