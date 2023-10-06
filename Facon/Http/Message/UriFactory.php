<?php

namespace Facon\Http\Message;

use Facon\Http\Message\{UriInterface, HttpUri};

class UriFactory implements UriFactoryInterface {
    public function createUri(string $uri = ''): UriInterface {
        return new HttpUri($uri);
    }
}
