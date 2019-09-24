<?php

use Framework\Extensions\TwigRouteExtension;
use Framework\Factory\PdoFactory;
use Framework\Factory\TwigRendererFactory;
use Framework\Renderer\RendererInterface;
use function DI\factory;
use function DI\get;

return [
    // View path
    'view.path' => dirname(__DIR__) . '/views',

    // Cache path
    'cache.path' => null,  // dirname(__DIR__) . '/cache',


    // Extensions
    'extensions' => [
        get(TwigRouteExtension::class),
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    PDO::class => factory(PdoFactory::class),



];
