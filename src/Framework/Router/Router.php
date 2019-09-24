<?php


namespace Framework\Router;

use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;

class Router
{

    /**
     * @var RouterContainer
     */
    private $routerContainer;

    /**
     * Router constructor.
     * @param RouterContainer $routerContainer
     */
    public function __construct(RouterContainer $routerContainer)
    {
        $this->routerContainer = $routerContainer;
    }

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function get(string $uri, $handler, string $name)
    {
        $this->routerContainer->getMap()->get($name, $uri, $handler);
    }

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function post(string $uri, $handler, string $name)
    {
        $this->routerContainer->getMap()->post($name, $uri, $handler);
    }

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function put(string $uri, $handler, string $name)
    {
        $this->routerContainer->getMap()->put($name, $uri, $handler);
    }

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function delete(string $uri, $handler, string $name)
    {
        $this->routerContainer->getMap()->delete($name, $uri, $handler);
    }

    /**
     * @param string $name
     * @param array|null $params
     * @return false|string
     * @throws \Aura\Router\Exception\RouteNotFound
     */
    public function uri(string $name, ?array $params = [])
    {
        return $this->routerContainer->getGenerator()->generate($name, $params);
    }

    /**
     * @param array $routes
     * @return $this
     */
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

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request)
    {
        $matcher = $this->routerContainer->getMatcher();
        $route = $matcher->match($request);
        if ($route) {
            return new Route($route->name, $route->attributes, $route->handler);
        }
        return null;
    }
}
