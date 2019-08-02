<?php


namespace Components;

use Components\Router\Annotation\Reader;
use Components\Router\Router;
use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
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
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct()
    {
        $this->getContainer()->get(Router::class)->addRoutes($this->getRoutes());
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


    private function getRoutes()
    {
        $reader = new Reader([dirname(__DIR__) . '/app']);
        $reader->run();
        return $reader->getRoutes();
    }

    /**
     * Renvoie une instance du container
     * @return Container
     * @throws Exception
     */
    private function getContainer()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(dirname(__DIR__) . '/config/config.php');
        $this->container = $builder->build();
        return $this->container;
    }
}
