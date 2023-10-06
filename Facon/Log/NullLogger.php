<?php

namespace Facon\Log;


/**
 * Tendra todos los metodos de la LoggerInterface, 
 * pero no generara ningun resultado ni efecto secundario.
 * 
 * Su uso sera para entornos de prueba donde no se requiera guardar logs.
 * Ejemplo: Durante la ejecucion de test unitarios.
 */

 class NullLogger implements LoggerInterface {

    public function emergency(object|string $message, array $context = []): void{

    }

    public function alert(object|string $message, array $context = []): void{

    }

    public function critical(object|string $message, array $context = []): void{

    }

    public function error(object|string $message, array $context = []): void{

    }

    public function warning(object|string $message, array $context = []): void{

    }

    public function notice(object|string $message, array $context = []): void{

    }

    public function info(object|string $message, array $context = []): void{

    }

    public function debug(object|string $message, array $context = []): void{

    }

    public function log($level, object|string $message, array $context = []): void{

    }
}