<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use ReflectionClass;

trait Logger
{
    /**
     * Default log channel.
     */
    protected const DEFAULT_CHANNEL = 'stack';

    /**
     * Default log stack channels.
     */
    protected const DEFAULT_STACK = ['daily'];

    /**
     * Log a message with a given level to a specified channel.
     *
     * @param string $level           The log level (e.g., 'emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug')
     * @param string $message         The message to log.
     * @param array  $context         Optional contextual data.
     * @param string $channel         The log channel, default is self::DEFAULT_CHANNEL.
     * @param array  $additionalStack Additional channels to include in the stack.
     *
     * @return void
     */
    public function log(
        string $level,
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        try {
            $stack = array_merge(self::DEFAULT_STACK, [$channel], $additionalStack);
            Log::stack($stack)->{$level}($message, $context);
        } catch (Exception $e) {
            // Fallback to basic error_log if Laravel logging fails
            error_log("Failed to log message: {$message}. Error: {$e->getMessage()}");
        }
    }

    public function logInfo(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'info',
            $this->getLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    public function logDebug(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'debug',
            $this->getShortClassLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    public function logWarning(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'warning',
            $this->getLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    public function logError(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'error',
            $this->getShortClassLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    /**
     * Log an emergency message.
     *
     * @param string $message         The message to log
     * @param array  $context         Optional contextual data
     * @param string $channel         The log channel
     * @param array  $additionalStack Additional channels to include in the stack
     *
     * @return void
     */
    public function logEmergency(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'emergency',
            $this->getShortClassLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    /**
     * Log an alert message.
     *
     * @param string $message         The message to log
     * @param array  $context         Optional contextual data
     * @param string $channel         The log channel
     * @param array  $additionalStack Additional channels to include in the stack
     *
     * @return void
     */
    public function logAlert(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'alert',
            $this->getShortClassLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    /**
     * Log a critical message.
     *
     * @param string $message         The message to log
     * @param array  $context         Optional contextual data
     * @param string $channel         The log channel
     * @param array  $additionalStack Additional channels to include in the stack
     *
     * @return void
     */
    public function logCritical(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = ['slack']
    ): void {
        $this->log(
            'critical',
            $this->getShortClassLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    /**
     * Log a notice message.
     *
     * @param string $message         The message to log
     * @param array  $context         Optional contextual data
     * @param string $channel         The log channel
     * @param array  $additionalStack Additional channels to include in the stack
     *
     * @return void
     */
    public function logNotice(
        string $message,
        array $context = [],
        string $channel = self::DEFAULT_CHANNEL,
        array $additionalStack = []
    ): void {
        $this->log(
            'notice',
            $this->getLogPrefix() . $message,
            $context,
            $channel,
            $additionalStack
        );
    }

    private function getLogPrefix(): string
    {
        $class = (new ReflectionClass($this))->getShortName();
        $prefix = $this->extractLogPrefixFromClassName($class);
        return "[$prefix]: ";
    }

    /**
     * Extracts the log prefix from a class name by concatenating its capital letters.
     *
     * @param string $className
     * @return string
     */
    private function extractLogPrefixFromClassName(string $className): string
    {
        preg_match_all('/[A-Z]/', $className, $matches);
        return implode('', $matches[0]);
    }

    /**
     * Returns the short class name as a log prefix, e.g., [UserController]:
     *
     * @return string
     */
    private function getShortClassLogPrefix(): string
    {
        $class = (new ReflectionClass($this))->getShortName();
        return "[{$class}]: ";
    }
}
