<?php
namespace Framework\Renderer;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class TwigRenderer implements RendererInterface
{
    /***
     * Represente le chemin vers les caches des vues
     * @var string
     */
    private $twig;

    /***
     * Renderer constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
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

    public function addGlobal($name, $value)
    {
        $this->twig->addGlobal($name, $value);
    }
}
