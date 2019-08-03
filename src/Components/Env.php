<?php


namespace Components;

use Dotenv\Dotenv;

class Env
{

    public static function load()
    {
        $dotenv = Dotenv::create(dirname(dirname(__DIR__)));
        $dotenv->load();
    }
}
