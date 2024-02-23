<?php

namespace App\Core;

use DateTime;
use Psr\Log\AbstractLogger;

/**
 * Logger class.
 *
 * This class provides a basic implementation of a logger that extends AbstractLogger
 * from the PSR-3 logging standard. It writes log messages to a specified log file.
 */
class Logger extends AbstractLogger
{
    /** @var string Path to the log file. */
    private $logFilePath;

    /**
     * Constructor.
     *
     * Initializes the logger with the specified log file path.
     *
     * @param string $logFilePath The path to the log file.
     */
    public function __construct($logFilePath)
    {
        $this->logFilePath = $logFilePath;
    }

    /**
     * Log method.
     *
     * Writes a log message to the log file.
     *
     * @param string $level The log level (e.g., 'info', 'warning', 'error').
     * @param string|\Stringable $message The log message.
     * @param array $context Optional contextual data to interpolate into the message.
     * @return void
     */
    public function log($level, string|\Stringable $message, array $context = []): void
    {
        // The context array can be interpolated into the $message
        $message = $this->interpolate($message, $context);

        $date = new DateTime();
        $formattedMessage = sprintf(
            "[%s] [%s]: %s%s",
            $date->format('Y-m-d H:i:s'),
            strtoupper($level),
            $message,
            PHP_EOL
        );
        file_put_contents($this->logFilePath, $formattedMessage, FILE_APPEND | LOCK_EX);
    }

    /**
     * Interpolate method.
     *
     * Interpolates replacement values into the message.
     *
     * @param string $message The log message.
     * @param array $context Optional contextual data to interpolate into the message.
     * @return string The interpolated message.
     */
    protected function interpolate($message, array $context = [])
    {
        // Build a replacement array with braces around the context keys
        $replace = [];
        foreach ($context as $key => $val) {
            // Check that the value can be cast to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        // Interpolate replacement values into the message and return
        return strtr($message, $replace);
    }
}
