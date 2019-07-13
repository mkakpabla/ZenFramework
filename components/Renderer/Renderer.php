<?php
namespace Components\Renderer;

use Jenssegers\Blade\Blade;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Renderer implements RendererInterface
{

    /***
     * Represente le chemin vers les vues
     * @var string
     */
    private $loader;
    /***
     * Represente le chemin vers les caches des vues
     * @var string
     */
    private $twig;


    public function __construct(string $viewPath, string $cachePath, array $extensions = [])
    {
        $this->loader = new FilesystemLoader($viewPath);
        $this->twig = new Environment($this->loader, [
            'cache' => false //$cachePath
        ]);
        $this->addExtension($extensions);
        //$this->viewPath = $viewPath;
        //$this->cachePath = $cachePath;
    }



    public function render(string $view, ?array $data = []): string
    {
        return $this->twig->render($view, $data);
        //$blade = new Blade($this->viewPath, $this->cachePath);
        //return $blade->render($view, $data);
        //return require $this->viewPath . $view . '.php';
    }

    public function addExtension(array $extensions): void
    {
        foreach ($extensions as $extension) {
            $this->twig->addExtension($extension);
        }
    }
}