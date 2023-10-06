<?php

namespace Facon\Http\Message;

use Facon\Http\Message\ResponseInterface;

class ResponseFactory implements ResponseFactoryInterface {
    public function createResponse(int $code = 200, string $reasonPhrase = ''): ResponseInterface {
        return new HttpResponse($code, [], null, '1.1', $reasonPhrase);
    }
}
