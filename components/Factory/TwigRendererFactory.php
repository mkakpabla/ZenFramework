<?php

namespace Components\Factory;

use Components\Renderer\TwigRenderer;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererFactory
{

    public function __invoke(ContainerInterface $container)
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
        return new TwigRenderer($twig);
    }
}
