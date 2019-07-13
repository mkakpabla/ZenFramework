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

    protected function setUp(): void
    {
        $this->router = new Router();
    }

    public function testRun()
    {
        $request = new ServerRequest('GET', '/welcome');
        $this->router->get('/welcome', function (){ return "Welcome"; }, 'welcome');
        $app = new App([
            new RouterMiddleware($this->router),
            new NotFoundMiddleware()
        ]);
        $response = $app->run($request);
        $this->assertEquals('Welcome', $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

    }

    public function testRunController()
    {
        $request = new ServerRequest('GET', '/welcome');
        $this->router->get('/welcome', '\App\Controllers\HomeController#index', 'welcome');
        $app = new App([
            new RouterMiddleware($this->router),
            new NotFoundMiddleware()
        ]);
        $response = $app->run($request);
        $this->assertEquals('welcome', $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }


    public function testNotFound()
    {
        $request = new ServerRequest('GET', '/azeerrr');
        $this->router->get('/welcome', function (){ return "Welcome"; }, 'welcome');
        $app = new App([
            new RouterMiddleware($this->router),
            new NotFoundMiddleware()
        ]);
        $response = $app->run($request);
        $this->assertEquals('<h1>404 Not Found</h1>', $response->getBody());
        $this->assertEquals(404, $response->getStatusCode());

    }
}