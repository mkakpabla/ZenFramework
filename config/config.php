<?php

use Components\Extensions\TwigRouteExtension;
use Components\Factory\TwigRendererFactory;
use Components\Renderer\RendererInterface;
use Components\Router\Router;
use function DI\autowire;
use function DI\factory;
use function DI\get;

return [
    // View config
    'view.path' => dirname(__DIR__) . '/views',
    'cache.path' => dirname(__DIR__) . '/cache',
    
    // Extensions Twig
    'twig.extensions' => [
        get(TwigRouteExtension::class)
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    Router::class => autowire()
];
