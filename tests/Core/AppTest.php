<?php
namespace Tests\Core;

use Core\App;
use Core\Router\Router;
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
        $app = new App($this->router, []);
        $response = $app->run($request);
        $this->assertEquals('Welcome', $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());

    }
}