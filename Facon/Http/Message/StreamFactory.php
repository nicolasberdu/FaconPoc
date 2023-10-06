<?php

namespace Facon\Http\Message;

use Facon\Http\Message\StreamInterface;

class StreamFactory implements StreamFactoryInterface {
    public function createStream(string $content = ''): StreamInterface {
        return new Stream($content);
    }
}
