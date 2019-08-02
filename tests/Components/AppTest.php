<?php
namespace Tests\Core;

use Components\App;
use Components\Middlewares\NotFoundMiddleware;
use Components\Middlewares\RouterMiddleware;
use Components\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    /**
     * @var Router
     */
    private $router;
    /**
     * @var App
     */
    private $app;

    protected function setUp(): void
    {
        $this->router = new Router();
        $this->app = new App();
        $this->app->pipe(RouterMiddleware::class)
            ->pipe(NotFoundMiddleware::class);
    }

    public function testNotFound()
    {
        $request = new ServerRequest('GET', '/azeerrr');
        $this->router->get('/welcome', function () {
            return "Welcome";
        }, 'welcome');
        $response = $this->app->run($request);
        $this->assertEquals('<h1>404 Not Found</h1>', $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
}
