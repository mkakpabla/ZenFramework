<?php
namespace Components\Helpers;

trait Redirect
{

    public static function to(string $redierctLink)
    {
        header("Location: $redierctLink");
        exit();
    }
}