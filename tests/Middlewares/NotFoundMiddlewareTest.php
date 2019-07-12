<?php


namespace Test\Middlewares;

use Components\Middlewares\NotFoundMiddleware;
use GuzzleHttp\Psr7\ServerRequest;
use PHPUnit\Framework\TestCase;
use Psr\Http\Server\RequestHandlerInterface;

class NotFoundMiddlewareTest extends TestCase
{



    public function testSendNotFound()
    {
        $request = (new ServerRequest('GET', '/demo'));
        $handle = $this->getMockBuilder(RequestHandlerInterface::class)
            ->setMethods(['handle'])
            ->getMock();
        $middleware = new NotFoundMiddleware();
        $response = $middleware->process($request, $handle);
        $this->assertEquals(404, $response->getStatusCode());
    }

}