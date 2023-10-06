<?php

namespace Facon\Log;

/**
 * Describes a logger instance.
 *
 * The message MUST be a string or object implementing __toString().
 *
 * The message MAY contain placeholders in the form: {foo} where foo
 * will be replaced by the context data in key "foo".
 *
 * The context array can contain arbitrary data, the only assumption that
 * can be made by implementors is that if an Exception instance is given
 * to produce a stack trace, it MUST be in a key named "exception".
 *
 * See https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
 * for the full interface specification.
 */
interface LoggerInterface
{
    /**
     * System is unusable.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function emergency( object|string $message, array $context = array()) : void;

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function alert( object|string $message, array $context = array()) : void;

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function critical( object|string $message, array $context = array()) : void;

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function error( object|string $message, array $context = array()) : void;

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function warning( object|string $message, array $context = array()) : void;

    /**
     * Normal but significant events.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function notice( object|string $message, array $context = array()) : void;

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function info( object|string $message, array $context = array()) : void;

    /**
     * Detailed debug information.
     *
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function debug( object|string $message, array $context = array()) : void;

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param  object|string $message
     * @param array $context
     * @return void
     */
    public function log($level,  object|string $message, array $context = array()) : void;
}