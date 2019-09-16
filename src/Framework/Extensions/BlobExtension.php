<?php


namespace Framework\Extensions;

use Framework\Router\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class BlobExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('blob', [$this, 'blob'], ['is_safe' => ['html']])
        ];
    }

    public function blob($file)
    {
        $content = base64_encode($file->content);
        return "<embed src='data:{$file->type}; base64,{$content}' height='100'/>";
    }
}
