<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Core\ExceptionHandler;
use App\Core\Logger;
use App\Core\Router;

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(config('app.root'));
$dotenv->load();

// Create the logger
$logger = new Logger(config('app.root') . '/app.log');

// Set up exception handling
ExceptionHandler::register(config('app.env'), $logger);

// Generate routes
$router = new Router(config('controllers'));