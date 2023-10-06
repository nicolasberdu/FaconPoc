<?php

namespace Facon\Http\Message;

use Facon\Http\Message\ServerRequestInterface;

class ServerRequestFactory implements ServerRequestFactoryInterface {
    public function createServerRequest(string $method, $uri, array $serverParams = []): ServerRequestInterface {
        return new HttpServerRequest($method, $uri, [], null, '1.1', $serverParams);
    }
}
