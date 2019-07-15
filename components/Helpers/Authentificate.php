<?php
namespace Components\Helpers;

trait Authentificate
{


    public static function authentificate()
    {
        if (!isset($_SESSION['auth'])) {
            header("Location: /admin/login");
            exit();
        }
    }


    public static function guest()
    {
        if (isset($_SESSION['auth'])) {
            header("Location: /admin/properties");
            exit();
        }
    }
}
