<?php

namespace Facon\Http\Message;

use Facon\Http\Message\RequestInterface;
use Facon\Http\Message\UriInterface;

class RequestFactory implements RequestFactoryInterface {
    public function createRequest(string $method, $uri): RequestInterface {
        $uriFactory = new UriFactory();
        $uri = $uriFactory->createUri($uri);

        return new HttpRequest($uri, $method);
    }
}
