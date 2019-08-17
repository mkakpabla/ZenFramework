<?php

namespace Framework\Factory;

use Framework\Renderer\TwigRenderer;
use Framework\Session\SessionInterface;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererFactory
{

    public function __invoke(ContainerInterface $container, SessionInterface $session)
    {
        $loader = new FilesystemLoader($container->get('view.path'));
        $twig = new Environment($loader, [
            'cache' => false //'cache.path'
        ]);
        if ($container->has('twig.extensions')) {
            foreach ($container->get('twig.extensions') as $extension) {
                $twig->addExtension($extension);
            }
        }
        if ($session->has('errors')) {
            $twig->addGlobal('errors', $session->get('errors'));
            $session->delete('errors');
        }
        return new TwigRenderer($twig);
    }
}
