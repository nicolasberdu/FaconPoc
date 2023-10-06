<?php

namespace Facon\Log;

use Facon\Log\LoggerInterface;
use Facon\Log\LoggerAwareInterface;

class Logger implements LoggerInterface, LoggerAwareInterface{

    private LoggerInterface $logger;

    public function __construct(){
        
    }

    public function setLogger(LoggerInterface $logger) : void{
        $this->logger = $logger;
    }
    
    
    public function emergency(object|string $message, array $context = []): void{
        $this->logger->emergency($message, $context);
    }

    public function alert(object|string $message, array $context = []): void{
        $this->logger->alert($message, $context);
    }

    public function critical(object|string $message, array $context = []): void{
        $this->logger->critical($message, $context);
    }

    public function error(object|string $message, array $context = []): void{
        $this->logger->error($message, $context);
    }

    public function warning(object|string $message, array $context = []): void{
        $this->logger->warning($message, $context);
    }

    public function notice(object|string $message, array $context = []): void{
        $this->logger->notice($message, $context);
    }

    public function info(object|string $message, array $context = []): void{
        $this->logger->info($message, $context);
    }

    public function debug(object|string $message, array $context = []): void{
        $this->logger->debug($message, $context);
    }

    public function log($level, object|string $message, array $context = []): void{
        $this->logger->log($level, $message, $context);
    }
}