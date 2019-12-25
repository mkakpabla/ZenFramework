<?php
namespace Framework\Router;

use Aura\Router\Exception\RouteAlreadyExists;
use Aura\Router\Exception\RouteNotFound;
use Aura\Router\RouterContainer;
use Psr\Http\Message\ServerRequestInterface;
use ReflectionException;

class Router
{
    /**
     * @var RouterContainer
     */
    private $routerContainer;
    /**
     * @var RouteExtractor
     */
    private $extractor;

    /**
     * Router constructor.
     * @param RouterContainer $routerContainer
     * @param RouteExtractor $extractor
     */
    public function __construct(RouterContainer $routerContainer, ?RouteExtractor $extractor = null)
    {
        $this->routerContainer = $routerContainer;
        $this->extractor = $extractor;
    }

    /**
     * Ajouter les routes d'un action
     * @throws ReflectionException
     */
    public function extract(): self
    {
        $routes = $this->extractor->run();
        $this->addRoutes($routes);
        return $this;
    }

    /**
     * Générer une route à partir du nom
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

    /**
     * Permet d'ajouter des routes
     * @param array $routes
     * @return void
     */
    private function addRoutes(array $routes): void
    {
        foreach ($routes as $route) {
            $method = $route['method'];
            $url = $route['route'];
            $action = $route['action'];
            $name = $route['name'];
            try {
                $this->routerContainer->getMap()->$method($name, $url, $action);
            } catch (RouteAlreadyExists $e) {
            }
        }
    }
}
