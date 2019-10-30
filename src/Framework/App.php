<?php


namespace Framework;

use Aura\Router\RouterContainer;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use Framework\Router\ActionReader;
use Framework\Router\Router;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Container\ContainerInterface;

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

    private $modules = [];


    /**
     * App constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
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



    public function pipe(string $middleware)
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function addModule(string $module)
    {
        $this->modules[] = $module;
        return $this;
    }
    /**
     * @param ServerRequestInterface $request
     * @return Response
     * @throws Exception
     */
    public function run(ServerRequestInterface $request): ResponseInterface
    {
        foreach ($this->modules as $module) {
            $this->container->get($module);
        }
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
}
