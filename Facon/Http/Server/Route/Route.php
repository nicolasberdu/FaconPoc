<?php

namespace Facon\Http\Server\Route;

class Route {

    private static $instance;
    private $routes = [];

    private function __construct(){
        $this->register();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function register(){        
        require_once __BASE_PATH__ . '\App\Routes\api.php';
    }

    static function get(string $route, array $action){
        $routes[] = [
            'route' => $route, 
            'method' => 'GET', 
            'controller' => $action[0], 
            'endpoint' => $action[1]
        ];
    }

    // !!!!! Reescribir metodo
    public function findRoute(string $method){
        $path = (isset($_GET['url_path'])) ? $_GET['url_path'] : '';
        $method = strtoupper($method);
        foreach($this->routes as $route){
            if($path == $route['route']){
                if($method == $route['method']){
                    return $route;
                }
            }
        }
        throw new \Exception("The route is not found");
    }
}