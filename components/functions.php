<?php
if (!function_exists('config')) {
    function config(string $name)
    {
        return require dirname(__DIR__) . '/config/' . $name . '.php';
    }
}

if (!function_exists('redirect')) {
    function redirect(string $routeName)
    {

    }
}
