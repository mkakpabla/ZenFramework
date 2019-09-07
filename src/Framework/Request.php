<?php


namespace Framework;

use GuzzleHttp\Psr7\ServerRequest;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request extends ServerRequest implements ServerRequestInterface
{

    public function getParams()
    {
        return array_merge($this->getParsedBody(), $this->getUploadedFiles());
    }


}
