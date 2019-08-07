<?php
namespace Tests\Framework\Middlewares;

use Framework\Middlewares\TraillingSlashMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddlewareTest extends TestCase
{

    public function testRedirectIfSlash()
    {
        $request = (new ServerRequest('GET', '/demo/'));
        $handle = $this->getMockBuilder(RequestHandlerInterface::class)
            ->setMethods(['handle'])
            ->getMock();
        $middleware = new TraillingSlashMiddleware();
        $response = $middleware->process($request, $handle);
        $this->assertEquals(['/demo'], $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }

}
