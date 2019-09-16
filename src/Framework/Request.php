<?php

use GuzzleHttp\Psr7\ServerRequest;

class Request extends \GuzzleHttp\Psr7\Request
{


    public function getParams()
    {
        return array_merge($this->getParsedBody(), $this->getUploadedFiles());
    }
}
