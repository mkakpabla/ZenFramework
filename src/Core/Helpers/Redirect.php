<?php
namespace Core\Helpers;

trait Redirect
{

    public static function to(string $redierctLink)
    {
        header("Location: $redierctLink");
        exit();
    }
}