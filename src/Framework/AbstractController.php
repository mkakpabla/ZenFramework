<?php
namespace Framework;

use Framework\Renderer\RendererInterface;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /***
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /***
     * Returns a rendered view.
     * @param string $view
     * @param array|null $data
     * @return string
     */
    protected function render(string  $view, ?array $data = []): string
    {
        return $this->container->get(RendererInterface::class)->render($view, $data);
    }


    /***
     * Returns a RedirectResponse to the given route name with the given parameters.
     * @param string $routeName
     * @param array|null $params
     * @return \GuzzleHttp\Psr7\MessageTrait|Response
     */
    protected function redirect(string $routeName, ?array $params = [])
    {
        $uri = $this->container->get('router')->uri($routeName, $params);
        return (new Response())
            ->withStatus(301)
            ->withHeader('location', $uri);
    }


    /***
     * Adds a flash message to the current session for type.
     * @param string $type
     * @param string $message
     */
    protected function addFlash(string $type, string $message)
    {
        $flash = [];
        $flash[$type] = $message;
        $this->container->get('session')->set('flash', $flash);
    }
}
