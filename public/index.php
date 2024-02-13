<?php

use App\Core\Router;

require 'vendor/autoload.php';

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Generate routes
$router = new Router();

if ($route = $router->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])) {
    $controller = $route[0];
    $method = $route[1];

    // Instantiate the controller and call the method
    $controllerInstance = new $controller();
    $controllerInstance->$method();
}

abort();