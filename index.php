<?php

use Facon\Core\Main;

spl_autoload_register(function($class){
    $classFile = str_replace('\\', '/', $class) . '.php';

    if (file_exists($classFile)) {
        require_once $classFile;
    }
});
const __BASE_PATH__ = __DIR__;

$main = Main::getInstance();
$main->runApp();