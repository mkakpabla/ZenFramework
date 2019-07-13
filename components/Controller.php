<?php
namespace Components;


use Components\Helpers\Redirect;

class Controller
{
    use Redirect;

    public $renderer;


    public function __construct()
    {
        $this->renderer = new Renderer(
            dirname(__DIR__) . '/src/Views/',
            dirname(__DIR__) . '/cache//'
        );

    }
}