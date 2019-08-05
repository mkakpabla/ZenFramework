<?php
namespace Framework\Middlewares;

use Components\Router\Annotation\Reader;
use Components\Router\Route;
use Components\Router\Router;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AddRoutesMiddleware implements MiddlewareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $router = new Router();
        $router->addRoutes($this->getRoutes());
        $this->container->set(Router::class, $router);
    }


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        return $handler->handle($request);
    }

    private function getRoutes()
    {
        $reader = new Reader($this->container->get('controller.path'));
        $reader->run();
        return $reader->getRoutes();
    }
}
