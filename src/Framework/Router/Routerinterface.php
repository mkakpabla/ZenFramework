<?php
namespace Framework\Router;

use Aura\Router\Exception\RouteNotFound;
use Psr\Http\Message\ServerRequestInterface;

interface RouterInterface
{

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function get(string $uri, $handler, string $name);

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function post(string $uri, $handler, string $name);

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function put(string $uri, $handler, string $name);

    /**
     * @param string $uri
     * @param $handler
     * @param string $name
     */
    public function delete(string $uri, $handler, string $name);

    /**
     * @param string $name
     * @param array|null $params
     * @return false|string
     * @throws RouteNotFound
     */
    public function uri(string $name, ?array $params = []);

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request);
}
