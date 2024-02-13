<?php

require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Core\Router;

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Generate routes
$router = new Router();