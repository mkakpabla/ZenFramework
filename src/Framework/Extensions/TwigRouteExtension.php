<?php


namespace Framework\Extensions;

use Psr\Container\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigRouteExtension extends AbstractExtension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('route', [$this, 'route'])
        ];
    }

    public function route(string $name, ?array $params = [])
    {
        return $this->container->get('router')->uri($name, $params);
    }
}
