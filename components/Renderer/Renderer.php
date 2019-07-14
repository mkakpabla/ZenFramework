<?php
namespace Components\Renderer;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
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

    /***
     * Renderer constructor.
     * @param string $viewPath
     * @param string $cachePath
     * @param array $extensions
     */
    public function __construct(string $viewPath, string $cachePath, array $extensions = [])
    {
        $this->loader = new FilesystemLoader($viewPath);
        $this->twig = new Environment($this->loader, [
            'cache' => false //$cachePath
        ]);
        $this->addExtension($extensions);
    }


    /***
     * Permet de rendre une vue twig
     * @param string $view
     * @param array|null $data
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $view, ?array $data = []): string
    {
        $view = implode('/', explode('.', $view)) . '.twig';
        return $this->twig->render($view, $data);
    }

    /***
     * Ajoute les extensions à twig
     * @param array $extensions
     */
    public function addExtension(array $extensions): void
    {
        foreach ($extensions as $extension) {
            $this->twig->addExtension($extension);
        }
    }
}