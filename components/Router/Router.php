<?php


namespace Components\Router;

use Aura\Router\RouterContainer;
use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    private $routerContainer;
    /**
     * @var ContainerInterface
     */
    private $container;


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

    public function uri(string $name, ?array $params = [])
    {
        return $this->routerContainer->getGenerator()->generate($name, $params);
    }



    public function addRoutes(array $routes)
    {
        foreach ($routes as $route) {
            $method = $route['method'];
            $url = $route['route'];
            $action = $route['action'];
            $name = $route['name'];
            $this->$method($url, $action, $name);
        }
        return $this;
    }

    public function match(ServerRequestInterface $request)
    {
        $matcher = $this->routerContainer->getMatcher();
        $route = $matcher->match($request);
        if ($route) {
            return new Route($route->name, $route->attributes, $route->handler);
        }
        return null;
    }

/*
    public function run(ServerRequestInterface $request)
    {
        $route = $this->match($request);
        if ($route) {
            if (is_array($route->getHandler())) {
                $response = $this->container->call($route->getHandler(), $route->getAttributes());
                return new Response(200, [], $response);
            } elseif (is_callable($route->getHandler())) {
                $response =  $this->container->call($route->getHandler(), $route->getAttributes());
                return new Response(200, [], $response);
            } else {
                throw new Exception('Handler is not type array or callable');
            }
        }
    }
    */
}
