<?php

namespace Framework\Factory;

use Framework\Env;
use Framework\Renderer\TwigRenderer;
use Framework\Session\SessionInterface;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $loader = new FilesystemLoader($container->get('view.path'));
        $twig = new Environment($loader, [
            'cache' => $container->get('cache.path') ?: false
        ]);
        if ($container->has('twig.extensions')) {
            foreach ($container->get('twig.extensions') as $extension) {
                $twig->addExtension($extension);
            }
        }
        return new TwigRenderer($twig);
    }
}
