<?php


namespace Components\Router;

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

    public function get(string $uri, $handler, string $name)
    {
        $this->routerContainer->getMap()->get($name, $uri, $handler);
    }

    public function post(string $uri, $handler, string $name)
    {
        $this->routerContainer->getMap()->post($name, $uri, $handler);
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



}