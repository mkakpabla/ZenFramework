<?php


namespace Framework\Middlewares;


use Framework\ForbiddenException;
use GuzzleHttp\Psr7\Response;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ForbiddenExceptionMiddleware implements MiddlewareInterface
{


    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ForbiddenException $e) {
            $uri = $this->container->get('router')->uri('login');
            return (new Response())
                ->withStatus(301)
                ->withHeader('location', $uri);
        }
    }
}