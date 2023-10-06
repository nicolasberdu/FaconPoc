<?php

namespace Facon\Core;

use Facon\Http\Message\{
    HttpServerRequest,
    ServerRequestFactory,
    UriFactory,
    HttpUri
};
use Facon\Http\Server\Route\Route;

class Main {
    private static $instance;
    private HttpServerRequest $serverRequest;
    private Route $route;

    private function __construct() {
        $this->route = Route::getInstance();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function runApp(){

        $this->request();
        $route = $this->route->findRoute($this->serverRequest->getMethod());

    
    }


    private function request(){
        $requestFactory = new ServerRequestFactory;
        $uriFactory = new UriFactory;
        $uri = $uriFactory->createUri($_SERVER['REQUEST_URI']);

        $this->serverRequest = $requestFactory->createServerRequest($_SERVER['REQUEST_METHOD'], $uri);
    }
}
