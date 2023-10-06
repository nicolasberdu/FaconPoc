<?php

namespace Facon\Http\Message;

use Facon\Http\Message\{
    RequestInterface, 
    UriInterface, 
    StreamInterface
};

class HttpRequest implements RequestInterface {
    private $method;
    private $uri;
    private $headers = [];
    private $body;
    private $version;

    public function __construct($method, UriInterface $uri, array $headers = [], StreamInterface $body = null) {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getRequestTarget() {
        $target = $this->uri->getPath();
        if ($this->uri->getQuery()) {
            $target .= '?' . $this->uri->getQuery();
        }
        return $target;
    }

    public function withRequestTarget($requestTarget) {
        $new = clone $this;
        $new->uri = $this->uri->withPath($requestTarget);
        return $new;
    }

    public function getMethod() {
        return $this->method;
    }

    public function withMethod($method) {
        $new = clone $this;
        $new->method = $method;
        return $new;
    }

    public function getUri() {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false) {
        $new = clone $this;
        $new->uri = $uri;
        return $new;
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


    public function getProtocolVersion(){
        return '';
    }

    public function withProtocolVersion($version) {
        $new = clone $this;
        $new->version = $version;
        return $new;
    }
}
