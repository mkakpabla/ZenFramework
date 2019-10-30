<?php


namespace Framework\View;

use Framework\Router\Router;
use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigRouteExtension extends AbstractExtension
{
    /**
     * @var ContainerInterface
     */
    private $container;
    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('route', [$this, 'route'])
        ];
    }

    public function route(string $name, ?array $params = [])
    {
        return $this->router->uri($name, $params);
    }
}
