<?php

use Framework\Env;
use Framework\Extensions\FlashExtension;
use Framework\Extensions\FormExtension;
use Framework\Extensions\TwigRouteExtension;
use Framework\Factory\PdoFactory;
use Framework\Factory\SwiftMailerFactory;
use Framework\Factory\TwigRendererFactory;
use Framework\Renderer\RendererInterface;
use Framework\Session\PHPSession;
use Framework\Session\SessionInterface;
use function DI\factory;
use function DI\get;

Env::load();
return [

    'twig' => [
        'paths' => dirname(__DIR__) . '/views',
        'cache' => false,  // __DIR__ . '/cache',
        'extensions' => [
            TwigRouteExtension::class,
            FormExtension::class,
            FlashExtension::class
        ]
    ],

    'mail' => [
        'driver'    => env('MAIL_DRIVER', 'smtp'),
        'host'      => env('MAIL_HOST', 'localhost'),
        'port'      => env('MAIL_PORT', 1025),
        'username'  => env('MAIL_USERNAME'),
        'password'  => env('MAIL_PASSWORD'),
    ],

    'database' => [
        'host'      => env('DB_HOST', 'localhost'),
        'name'      => env('DB_DATABASE', 'zen'),
        'username'  => env('DB_USERNAME', 'root'),
        'password'  => env('DB_PASSWORD', 'root'),
    ],

    'session' => get(PHPSession::class),

    SessionInterface::class => get(PHPSession::class),

    PDO::class => factory(PdoFactory::class),

    Swift_Mailer::class => factory(SwiftMailerFactory::class),

    RendererInterface::class => factory(TwigRendererFactory::class),

];
