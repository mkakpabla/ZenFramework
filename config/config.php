<?php

use Framework\Extensions\TwigRouteExtension;
use Framework\Factory\PdoFactory;
use Framework\Factory\TwigRendererFactory;
use Framework\Renderer\RendererInterface;
use function DI\factory;
use function DI\get;

return [
    // View config
    'view.path' => dirname(__DIR__) . '/views',
    'cache.path' => dirname(__DIR__) . '/cache',

    // Controller path
    'controller.path' => [dirname(__DIR__) . '/app/Controllers'],

    // Extensions Twig
    'twig.extensions' => [
        get(TwigRouteExtension::class)
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    \Framework\Session\SessionInterface::class => \DI\autowire(\Framework\Session\Session::class),

    PDO::class => factory(PdoFactory::class),


];
