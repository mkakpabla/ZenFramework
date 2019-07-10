<?php
namespace Core\Components;

use Jenssegers\Blade\Blade;

class Renderer
{

    /***
     * Represente le chemin vers les vues
     * @var string
     */
    private $viewPath;
    /***
     * Represente le chemin vers les caches des vues
     * @var string
     */
    private $cachePath;


    public function __construct(string $viewPath, string $cachePath)
    {
        $this->viewPath = $viewPath;
        $this->cachePath = $cachePath;
    }



    public function render(string $view, ?array $data = [])
    {
        $blade = new Blade($this->viewPath, $this->cachePath);
        return $blade->render($view, $data);
        //return require $this->viewPath . $view . '.php';
    }
}