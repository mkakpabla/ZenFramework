<?php
namespace Components\Renderer;


interface RendererInterface
{

    /***
     * Permet de rendre une vue twig
     * @param string $view
     * @param array|null $data
     * @return string
     */
    public function render(string $view, ?array $data = []): string;


    /***
     * Ajoute les extensions à twig
     * @param array $extensions
     */
    public function addExtension(array $extensions): void;

}