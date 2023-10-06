<?php

namespace Facon\Http\Message;

use Facon\Http\Message\{
    ServerRequestInterface,
    StreamInterface,
    UriInterface
};

class HttpServerRequest extends HttpRequest implements ServerRequestInterface {
    private $serverParams = [];
    private $cookieParams = [];
    private $queryParams = [];
    private $uploadedFiles = [];
    private $parsedBody;
    private $attributes = [];

    public function __construct(
        $method,
        UriInterface $uri,
        array $headers = [],
        StreamInterface $body = null,
        string $version = '1.1',
        array $serverParams = []
    ) {
        parent::__construct($method, $uri, $headers, $body);
        $this->serverParams = $serverParams;
    }

    public function getServerParams() {
        return $this->serverParams;
    }

    public function getCookieParams() {
        return $this->cookieParams;
    }

    public function withCookieParams(array $cookies) {
        $new = clone $this;
        $new->cookieParams = $cookies;
        return $new;
    }

    public function getQueryParams() {
        return $this->queryParams;
    }

    public function withQueryParams(array $query) {
        $new = clone $this;
        $new->queryParams = $query;
        return $new;
    }

    public function getUploadedFiles() {
        return $this->uploadedFiles;
    }

    public function withUploadedFiles(array $uploadedFiles) {
        $new = clone $this;
        $new->uploadedFiles = $uploadedFiles;
        return $new;
    }

    public function getParsedBody() {
        return $this->parsedBody;
    }

    public function withParsedBody($data) {
        $new = clone $this;
        $new->parsedBody = $data;
        return $new;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function getAttribute($name, $default = null) {
        return $this->attributes[$name] ?? $default;
    }

    public function withAttribute($name, $value) {
        $new = clone $this;
        $new->attributes[$name] = $value;
        return $new;
    }

    public function withoutAttribute($name) {
        $new = clone $this;
        unset($new->attributes[$name]);
        return $new;
    }
}