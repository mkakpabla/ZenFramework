<?php


namespace Framework\Helpers;

use Framework\Router\Router;
use GuzzleHttp\Psr7\Response;

trait Redirect
{

    public function redirect(string $routeName, ?array $params = [])
    {
        $uri = $this->container->get(Router::class)->uri($routeName, $params);
        return (new Response())
            ->withStatus(301)
            ->withHeader('location', $uri);
    }
}
