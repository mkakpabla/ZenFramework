<?php
namespace Core\Components;

class Controller
{


    public $renderer;

    //public $pdo;

    public function __construct()
    {
        $this->renderer = new Renderer(
            dirname(dirname(dirname(__DIR__))) . '/views/',
            dirname(dirname(dirname(__DIR__))) . '/cache//'
        );
        //$this->pdo = $this->Database()->getPDO();

    }
}