<?php

use Components\Extensions\TwigRouteExtension;
use Components\Factory\PdoFactory;
use Components\Factory\TwigRendererFactory;
use Components\Renderer\RendererInterface;
use function DI\factory;
use function DI\get;

return [
    // View config
    'view.path' => dirname(__DIR__) . '/views',
    'cache.path' => dirname(__DIR__) . '/cache',

    // Controller path
    'controller.path' => [dirname(__DIR__) . '/src/App/Controllers'],

    // Extensions Twig
    'twig.extensions' => [
        get(TwigRouteExtension::class)
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    PDO::class => factory(PdoFactory::class),


];
