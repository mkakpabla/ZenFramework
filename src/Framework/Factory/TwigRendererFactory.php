<?php
namespace Framework\Factory;

use Framework\View\TwigRenderer;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRendererFactory
{

    public function __invoke(ContainerInterface $container)
    {
        $twigConfig = (object)$container->get('twig');
        $loader = new FilesystemLoader($twigConfig->paths);
        $twig = new Environment($loader, [
            'cache' => $twigConfig->cache
        ]);
        foreach ($twigConfig->extensions as $extension) {
            $twig->addExtension($container->get($extension));
        }
        return new TwigRenderer($twig);
    }
}
