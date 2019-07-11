<?php
namespace Core\Components;

use Core\Helpers\Redirect;

class Controller
{
    use Redirect;

    public $renderer;

    //public $pdo;

    public function __construct()
    {
        $this->renderer = new Renderer(
            dirname(dirname(dirname(__DIR__))) . '/views/',
            dirname(dirname(dirname(__DIR__))) . '/cache//'
        );

    }
}