<?php

namespace App\Infrastructure\Classes;

use Psr\Log\LoggerInterface;

/**
 * ExceptionHandler class.
 *
 * This class provides a basic exception handling mechanism. It logs exceptions
 * using a PSR-3 LoggerInterface instance and displays error messages based on
 * the application environment.
 */
class ExceptionHandler {
    /** @var string Application environment (e.g., 'development', 'production'). */
    private $environment;

    /** @var LoggerInterface PSR-3 logger instance. */
    private $logger;

    /**
     * Constructor.
     *
     * Initializes the ExceptionHandler with the specified environment and logger.
     *
     * @param string $environment The application environment.
     * @param LoggerInterface $logger The PSR-3 logger instance.
     */
    public function __construct($environment, LoggerInterface $logger) {
        $this->environment = $environment;
        $this->logger = $logger;
    }

    /**
     * Handle exception method.
     *
     * Logs the exception, sets the HTTP response code, and displays error messages
     * based on the application environment.
     *
     * @param \Throwable $exception The exception to handle.
     * @return void
     */
    public function handleException($exception): void {
        // Log the exception
        $this->logger->error($exception->getMessage());

        // Set HTTP response code
        http_response_code(500);

        // Display error message based on environment
        if ($this->environment !== 'production') {
            echo "An error occurred: " . $exception->getMessage();
        } else {
            echo "An error occurred. Please try again later.";
        }

        exit;
    }

    /**
     * Register method.
     *
     * Registers the exception handler with the specified environment and logger.
     *
     * @param string $environment The application environment.
     * @param LoggerInterface $logger The PSR-3 logger instance.
     * @return void
     */
    public static function register($environment, LoggerInterface $logger): void {
        $handler = new self($environment, $logger);
        set_exception_handler([$handler, 'handleException']);
    }
}
