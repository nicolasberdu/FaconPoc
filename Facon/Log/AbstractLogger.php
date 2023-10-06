<?php

namespace Facon\Log;

class AbstractLogger implements LoggerInterface{
    
    private LogConfig $logConfig;
    private bool $debugEnabled = false;

    public function __constuct(){
        
    }

    public function emergency(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::EMERGENCY, $message, $context);
        echo $log . PHP_EOL;
    }

    public function alert(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::ALERT, $message, $context);
        echo $log . PHP_EOL;
    }

    public function critical(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::CRITICAL, $message, $context);
        $this->printLog($log);
        echo $log . PHP_EOL;
    }

    public function error(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::ERROR, $message, $context);
        $this->printLog($log);
        echo $log . PHP_EOL;
    }

    public function warning(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::WARNING, $message, $context);
        $this->printLog($log);
        echo $log . PHP_EOL;
    }

    public function notice(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::NOTICE, $message, $context);
        echo $log . PHP_EOL;
    }

    public function info(object|string $message, array $context = []): void{
        if(!$this->validateMessage($message)){
            throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
        }

        $log = $this->formatter(LogLevel::INFO, $message, $context);
        echo $log . PHP_EOL;
    }

    public function debug(object|string $message, array $context = []): void{
        if($this->debugEnabled){
            if(!$this->validateMessage($message)){
                throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
            }

            $log = $this->formatter(LogLevel::DEBUG, $message, $context);
            echo $log . PHP_EOL;
        }
    }

    public function log($level, object|string $message, array $context = []): void{

        if($level != LogLevel::DEBUG || ($level == LogLevel::DEBUG && $this->debugEnabled)){

            if (!in_array($level, [LogLevel::EMERGENCY, LogLevel::ALERT, LogLevel::CRITICAL, LogLevel::ERROR, LogLevel::WARNING, LogLevel::NOTICE, LogLevel::INFO, LogLevel::DEBUG])) {
                throw new \InvalidArgumentException("Nivel de registro no válido: $level");
            }
    
            if(!$this->validateMessage($message)){
                throw new \InvalidArgumentException("La instancia de la clase " . get_class($message) . "::class no tiene metodo toString().");
            }
    
            $log = $this->formatter($level, $message, $context);
    
            if(in_array($level, [LogLevel::CRITICAL, LogLevel::ERROR, LogLevel::WARNING])){
                $this->printLog($log);
            }
            echo $log . PHP_EOL;
        }
    }

    private function validateMessage(&$message) : bool{
        if(gettype($message)=='string' || (gettype($message)=='object' &&  method_exists($message, '__toString'))) {
            $message = (string)$message;
            return true;
        }else{
            return false;
        }
    }

    private function formatter($level, string $message, array $context = []) : string{
        $date=date('Y-m-d H:i:s');

        $message = $this->fillPlaceholders($message, $context);

        $format= [
            "timestamp" => $date,
            "level" => $level,
            "message" => $message
        ];

        if (!empty($context)) {
            $format["context"] = $context;
        }

        return json_encode($format);
    }

    private function fillPlaceholders(string $message, array $context = []) : string{
        preg_match_all('/\{([A-Za-z0-9_.]+)\}/', $message, $matches);
        $placeholders = $matches[0];
        $keys = $matches[1];

        foreach ($placeholders as $index => $placeholders){
            $key = $keys[$index];

            if (isset($context[$key])){
                $message = str_replace($placeholders, $context[$key], $message);
            }
        }
        return $message;
    }

    private function printLog(string $lineLog) : void{
        $lineLog = mb_convert_encoding($lineLog, 'UTF-8', mb_list_encodings());
        $file = fopen("logs.log", "a");

        fwrite($file,$lineLog . PHP_EOL);
        
        fclose($file);
    }
}