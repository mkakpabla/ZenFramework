<?php
namespace Core\Components;


use App\Database\MysqlDatabase;
use Core\Components\Renderer;

class Controller
{


    public $renderer;

    //public $pdo;

    public function __construct()
    {
        $this->renderer = new Renderer(dirname(dirname(dirname(__DIR__))) . '/views/', dirname(dirname(dirname(__DIR__))) . '/views/cache//');
        //$this->pdo = $this->MysqlDatabase()->getPDO();

    }
    /*
    private function MysqlDatabase()
    {
        return new MysqlDatabase('localhost', 'agence_immobiliere', 'root', 'root');
    }
    */
}