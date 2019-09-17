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


    // Database Parameters
    'database.host'         => env('DB_HOST', 'localhost'),
    'database.name'         => env('DB_DATABASE', 'zen'),
    'database.username'     => env('DB_USERNAME', 'root'),
    'database.password'     => env('DB_PASSWORD', 'root'),

    // Controller path
    'controller.path' => [dirname(__DIR__) . '/app/Controllers'],

    // Extensions Twig
    'twig.extensions' => [
        get(TwigRouteExtension::class),
    ],

    RendererInterface::class => factory(TwigRendererFactory::class),

    PDO::class => factory(PdoFactory::class),



];
