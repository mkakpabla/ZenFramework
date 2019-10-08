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

return [

    SessionInterface::class => get(PHPSession::class),

    PDO::class => factory(PdoFactory::class),

    Swift_Mailer::class => factory(SwiftMailerFactory::class),

    RendererInterface::class => factory(TwigRendererFactory::class),

];
