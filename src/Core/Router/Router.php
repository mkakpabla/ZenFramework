<?php


namespace Core\Router;


use Aura\Router\RouterContainer;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    private $routerContainer;


    public function __construct()
    {
        $this->routerContainer = new RouterContainer();

    }

    public function get(string $uri, $callable, string $name)
    {
        $this->routerContainer->getMap()->get($name, $uri, $callable);
    }

    public function post(string $uri, $callable, string $name)
    {
        $this->routerContainer->getMap()->post($name, $uri, $callable);
    }

    public function match(ServerRequestInterface $request)
    {
        $matcher = $this->routerContainer->getMatcher();
        $route = $matcher->match($request);
        if ($route) {
            return new Route($route->name,  $route->attributes, $route->handler);
        }
        return null;
    }

    public function run(ServerRequestInterface $request)
    {
        $route = $this->match($request);
        if (!$route) {
            return new Response(404, [], '<h1>404 Not Found</h1>');
            /*
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
            */
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