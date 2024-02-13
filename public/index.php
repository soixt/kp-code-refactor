<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Commands\MigrateDatabaseCommand;
use App\Core\Router;

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Generate tables if they dont exist
MigrateDatabaseCommand::handle();

// Generate routes
$router = new Router();