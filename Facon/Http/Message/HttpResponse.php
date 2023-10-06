<?php

namespace Facon\Http\Message;

use Facon\Http\Message\{ResponseInterface, StreamInterface};

class HttpResponse implements ResponseInterface {
    private $statusCode;
    private $reasonPhrase;
    private $headers = [];
    private $body;

    public function __construct($statusCode, $reasonPhrase = '', array $headers = [], StreamInterface $body = null) {
        $this->statusCode = $statusCode;
        $this->reasonPhrase = $reasonPhrase;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode() {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = '') {
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase = $reasonPhrase;
        return $new;
    }

    public function getReasonPhrase() {
        return $this->reasonPhrase;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function hasHeader($name) {
        return isset($this->headers[strtolower($name)]);
    }

    public function getHeader($name) {
        $name = strtolower($name);
        if (!$this->hasHeader($name)) {
            return [];
        }
        return $this->headers[$name];
    }

    public function getHeaderLine($name) {
        $header = $this->getHeader($name);
        return implode(', ', $header);
    }

    public function withHeader($name, $value) {
        $new = clone $this;
        $new->headers[strtolower($name)] = is_array($value) ? $value : [$value];
        return $new;
    }

    public function withAddedHeader($name, $value) {
        $new = clone $this;
        $name = strtolower($name);
        if (isset($new->headers[$name])) {
            $new->headers[$name] = array_merge($new->headers[$name], is_array($value) ? $value : [$value]);
        } else {
            $new->headers[$name] = is_array($value) ? $value : [$value];
        }
        return $new;
    }

    public function withoutHeader($name) {
        $new = clone $this;
        $name = strtolower($name);
        unset($new->headers[$name]);
        return $new;
    }

    public function getBody() {
        return $this->body;
    }

    public function withBody(StreamInterface $body) {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
}
