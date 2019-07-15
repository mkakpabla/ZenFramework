<?php

use Components\Extensions\TwigRouteExtension;
use Components\Factory\TwigRendererFactory;
use Components\Renderer\RendererInterface;
use Components\Router\Route;
use Components\Router\Router;
use function DI\create;
use function DI\factory;
use function DI\get;
use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;

return [
    'view.path' => dirname(__DIR__) . '/views',
    'cache.path' => dirname(__DIR__) . '/cache',
    // Extensions Twig
    'twig.extensions' => [
        get(TwigRouteExtension::class)
    ],
    ServerRequestInterface::class => ServerRequest::fromGlobals(),
    RendererInterface::class => factory(TwigRendererFactory::class)
];