<?php

session_start();

use App\Core\Router;

require 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Generate routes
$router = new Router();