<?php


namespace Framework\Router;

use Psr\Http\Message\ServerRequestInterface;

interface Routerinterface
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
     * @throws \Aura\Router\Exception\RouteNotFound
     */
    public function uri(string $name, ?array $params = []);

    /**
     * @param ServerRequestInterface $request
     * @return Route|null
     */
    public function match(ServerRequestInterface $request);

}
