<?php
namespace App\helpers;

class Redirect
{

    public static function to(string $redierctLink)
    {
        header("Location: $redierctLink");
        exit();
    }
}