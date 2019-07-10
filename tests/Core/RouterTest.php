<?php


namespace Test\Core;


use Core\Router\Router;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;

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
        $this->router->get('/welcome', function (){ return "Welcome"; }, 'welcome');
        $route = $this->router->match($request);
        $this->assertEquals('Welcome', call_user_func_array($route->getHandler(), []));
        $this->assertEquals('welcome', $route->getName());
    }

    public function testGetMethodWithController()
    {
        $request = new ServerRequest('GET', '/welcome');
        $this->router->get('/welcome', '\App\Controller\HomeController#welcome', 'welcome');
        $route = $this->router->match($request);
        $this->assertEquals('\App\Controller\HomeController#welcome', $route->getHandler());
    }

    public function testGetMethodNotFound()
    {
        $request = new ServerRequest('GET', '/notfound');
        $this->router->get('/welcome', '\App\Controller\HomeController#welcome', 'welcome');
        $route = $this->router->match($request);
        $this->assertEquals(null, $route);
    }


}