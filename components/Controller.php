<?php
namespace Components;


use Components\Helpers\Redirect;
use Components\Renderer\Renderer;

class Controller
{
    use Redirect;

    public $renderer;


    public function __construct()
    {
        $this->renderer = new Renderer(
            dirname(__DIR__) . '/views/',
            dirname(__DIR__) . '/cache/',
            config('twig')
        );
    }

    protected function render(string  $view)
    {
        return $this->renderer->render($view);
    }
}