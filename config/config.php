<?php

use Framework\Factory\PdoFactory;
use Framework\Factory\SwiftMailerFactory;
use Framework\Factory\TwigRendererFactory;
use Framework\View\FlashExtension;
use Framework\View\FormExtension;
use Framework\View\RendererInterface;
use Framework\Security\Password;
use Framework\Security\PasswordInerface;
use Framework\Session\PHPSession;
use Framework\Session\SessionInterface;
use Framework\View\TwigRouteExtension;
use function DI\factory;
use function DI\get;

return [


    // Configuration de la base de donnée
    'database' => [
        'host'      => getenv('DB_HOST') ?: 'localhost',
        'name'      => getenv('DB_DATABASE') ?: 'zen',
        'username'  => getenv('DB_USERNAME') ?: 'root',
        'password'  => getenv('DB_PASSWORD') ?: 'root',
    ],


    // Configuration de twig
    'twig' => [
        'paths' => dirname(__DIR__) . '/templates',
        'cache' => false,  // __DIR__ . '/cache',
        'extensions' => [
            TwigRouteExtension::class,
            FormExtension::class,
            FlashExtension::class
        ]
    ],


    // Configuration de mail
    'mail' => [
        'driver'    => getenv('MAIL_DRIVER') ?: 'smtp',
        'host'      => getenv('MAIL_HOST') ?: 'localhost',
        'port'      => getenv('MAIL_PORT') ?: 1025,
        'username'  => getenv('MAIL_USERNAME'),
        'password'  => getenv('MAIL_PASSWORD'),
    ],


    SessionInterface::class => get(PHPSession::class),
    PDO::class => factory(PdoFactory::class),
    Swift_Mailer::class => factory(SwiftMailerFactory::class),
    RendererInterface::class => factory(TwigRendererFactory::class),
    PasswordInerface::class => get(Password::class),
];
