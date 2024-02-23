<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Commands\MigrateDatabaseCommand;
use App\Core\ExceptionHandler;
use App\Core\Logger;
use App\Core\Router;

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Create the logger
$logger = new Logger(__DIR__.'/../app.log');

// Generate tables if they dont exist
MigrateDatabaseCommand::handle();

// Set up exception handling
ExceptionHandler::register(config('app.env'), $logger);

// Generate routes
$router = new Router();