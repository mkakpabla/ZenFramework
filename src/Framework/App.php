<?php


namespace Framework;

use Exception;
use DI\Container;
use DI\NotFoundException;
use DI\DependencyException;
use Framework\Router\Router;
use GuzzleHttp\Psr7\Response;
use Aura\Router\RouterContainer;
use Framework\Router\RouteExtractor;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class App
 * @package Components
 */
class App implements RequestHandlerInterface
{

    /**
     * Liste des middleware
     * @var array
     */
    private $middlewares = [];
    /**
     * Indice du middleware en cours
     * @var int
     */
    private $index = 0;
    /**
     * @var Container
     */
    private $container;



    /**
     * App constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->extractRoute();
    }

    /**
     * Handles a request and produces a response.
     * May call other collaborating code to generate the response.
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     * @throws Exception
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = $this->getMiddleware();
        if (is_null($middleware)) {
            throw new Exception();
        } elseif ($middleware instanceof MiddlewareInterface) {
            return $middleware->process($request, $this);
        }
    }



    /**
     * Permet d'ajouter un nouveau middleware
     */
    public function pipe(string $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }
    /**
     * @param ServerRequestInterface $request
     * @return Response
     * @throws Exception
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        return $this->handle($request);
    }

    /**
     * @return object
     * @throws DependencyException
     * @throws NotFoundException
     */
    private function getMiddleware()
    {
        if (array_key_exists($this->index, $this->middlewares)) {
            $middleware = $this->container->get($this->middlewares[$this->index]);
            $this->index++;
            return $middleware;
        }
        return null;
    }


    /**
     * Extraire les routes des controllers
     */
    private function extractRoute()
    {
        //dd($this->container->get('router')['cache']);
        $router = (new Router(
            new RouterContainer(),
            new RouteExtractor(
                $this->container->get('router')['controller'],
                $this->container->get('router')['cache']))
            )->extract();
        
        $this->container->set(Router::class, $router);
    }
}
