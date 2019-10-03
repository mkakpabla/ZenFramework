<?php
namespace Framework\Extensions;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FormExtension extends AbstractExtension
{


    public function getFunctions()
    {
        return [
            new TwigFunction('Input', [$this, 'input'], ['is_safe' => ['html']]),
            new TwigFunction('Textarea', [$this, 'textarea'], ['is_safe' => ['html']])
        ];
    }


    public function input(string $name, string $type = 'text', string $class = 'form-control'): string
    {
        return "<input id='{$name}' class='{$class}' type='{$type}' name='{$name}'>";
    }
}
