<?php


namespace Components\Extensions;


use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class RouteExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('slug', [$this, 'slug'])
        ];
    }

    public function slug(string $username)
    {
        return $username;
    }

}