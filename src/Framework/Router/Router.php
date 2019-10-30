<?php
namespace Framework\Router;

use Aura\Router\Exception\RouteAlreadyExists;
use Aura\Router\Exception\RouteNotFound;
use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;

class Router
{


    private $routes = [];
    /**
     * @var RouterContainer
     */
    private $routerContainer;
    /**
     * @var ActionReader
     */
    private $reader;

    /**
     * Router constructor.
     * @param RouterContainer $routerContainer
     * @param ActionReader $reader
     */
    public function __construct(RouterContainer $routerContainer, ActionReader $reader)
    {
        $this->routerContainer = $routerContainer;
        $this->reader = $reader;
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
     * @throws RouteNotFound
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
            try {
                $this->$method($url, $action, $name);
            } catch (RouteAlreadyExists $e) {
            }
        }
    }

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request): ?Route
    {
        $matcher = $this->routerContainer->getMatcher();
        $route = $matcher->match($request);
        if ($route) {
            return new Route($route->name, $route->attributes, $route->handler);
        }
        return null;
    }

    public function addAction(string $action)
    {
        $routes = $this->reader->buildRoutes($action);
        $this->addRoutes($routes);
    }
}
