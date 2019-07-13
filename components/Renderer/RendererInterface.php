<?php


namespace Components\Renderer;


interface RendererInterface
{


    public function render(string $view, ?array $data = []): string;



    public function addExtension(array $extensions): void;

}