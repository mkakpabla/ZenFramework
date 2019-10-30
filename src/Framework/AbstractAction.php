<?php


namespace Framework;

use Framework\Session\FlashService;
use Framework\View\RendererInterface;
use GuzzleHttp\Psr7\MessageTrait;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractAction
{


    /**
     * @var ContainerInterface
     */
    protected $container;

    /***
     * Controller constructor.
     * @param ContainerInterface $container
     * @return AbstractController
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }

    /***
     * Returns a rendered view.
     * @param string $view
     * @param array|null $data
     * @return ResponseInterface
     */
    protected function render(string  $view, ?array $data = []): ResponseInterface
    {
        $response = $this->container
            ->get(RendererInterface::class)
            ->render($view, $data);
        return new Response(200, [], $response);
    }

    protected function renderView(string  $view, ?array $data = []): string
    {
        return $this->container
            ->get(RendererInterface::class)
            ->render($view, $data);
    }


    /***
     * Returns a RedirectResponse to the given route name with the given parameters.
     * @param string $routeName
     * @param array|null $params
     * @return MessageTrait|Response
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
        $this->container->get(FlashService::class)->set($type, $message);
    }
}
