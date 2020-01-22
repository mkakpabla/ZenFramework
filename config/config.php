<?php

use Framework\Env;
use App\Models\User;
use function DI\get;
use function DI\factory;
use Framework\Security\Password;
use Framework\Factory\PdoFactory;
use Framework\Session\PHPSession;
use Framework\View\FormExtension;
use Framework\View\FlashExtension;
use Framework\View\RendererInterface;
use Framework\View\TwigRouteExtension;
use Framework\Session\SessionInterface;
use Framework\Factory\SwiftMailerFactory;
use Framework\Security\PasswordInterface;
use Framework\Factory\TwigRendererFactory;

return [


    // Configuration de la base de donnée
    'database' => [
        'host'      => Env::get('DB_HOST', 'localhost'),
        'name'      => Env::get('DB_DATABASE', 'zen'),
        'username'  => Env::get('DB_USERNAME', 'root'),
        'password'  => Env::get('DB_PASSWORD', 'root'),
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
        'driver'    => Env::get('MAIL_DRIVER', 'smtp'),
        'host'      => Env::get('MAIL_HOST', 'localhost'),
        'port'      => Env::get('MAIL_PORT', 1025),
        'username'  => Env::get('MAIL_USERNAME'),
        'password'  => Env::get('MAIL_PASSWORD'),
    ],

    'auth' => [
        'user' => get(User::class)
    ],


    SessionInterface::class => get(PHPSession::class),
    PDO::class => factory(PdoFactory::class),
    Swift_Mailer::class => factory(SwiftMailerFactory::class),
    RendererInterface::class => factory(TwigRendererFactory::class),
    PasswordInterface::class => get(Password::class)
];
