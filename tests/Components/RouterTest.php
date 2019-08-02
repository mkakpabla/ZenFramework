<?php


namespace Test\Core;

use App\Controllers\HomeController;
use Components\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ServerRequestInterface;

class RouterTest extends TestCase
{

    /**
     * @var Router
     */
    private $router;

    protected function setUp(): void
    {
        $this->router = new Router();
    }

    public function testGetMethodWithCallable()
    {
        $request = new ServerRequest('GET', '/welcome');
        $this->router->get('/welcome', function () {
            return "Welcome";
        }, 'welcome');
        $route = $this->router->match($request);
        $this->assertEquals('Welcome', call_user_func_array($route->getHandler(), []));
        $this->assertEquals('welcome', $route->getName());
    }

    public function testGetMethodWithAttribute()
    {
        $request = new ServerRequest('GET', '/welcome/michel');
        $this->router->get('/welcome/{name}', function (ServerRequestInterface $request, $name) {
            return $name;
        },
            'welcome');
        $route = $this->router->match($request);
        $this->assertEquals('welcome', $route->getName());
    }

    public function testPostMethod()
    {
        $request = new ServerRequest('POST', '/welcome');
        $this->router->post('/welcome', function () {
            return "Welcome";
        }, 'welcome');
        $route = $this->router->match($request);
        $this->assertEquals('Welcome', call_user_func_array($route->getHandler(), []));
        $this->assertEquals('welcome', $route->getName());
    }
}
