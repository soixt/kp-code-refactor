<?php

namespace App\Core;

use ReflectionClass;
use ReflectionMethod;

class Router {
    private array $routes = [];
    protected string $requestMethod;

    public function __construct() {
        $this->generateRoutes();
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->handleRoute($_SERVER['REQUEST_URI']);
    }

    public function addRoute(string $method, string $path, array $controller): void {
        $this->routes[$method][$path] = $controller;
    }

    public function match(string $method, string $uri): ?array {
        if (isset($this->routes[$method][$uri])) {
            return $this->routes[$method][$uri];
        }
        return null;
    }

    public function handleRoute ($request) {
        $data = parse_url($request);
        $route = $this->match($this->requestMethod, $data['path']);

        if ($route) {
            $controller = $route[0];
            $method = $route[1];
        
            // Instantiate the controller and call the method
            $controllerInstance = new $controller();
            $controllerInstance->$method();
        } else {
            abort();
        }
    }

    public function getRoutes(): array {
        return $this->routes;
    }

    public function generateRoutes(): void {
        $controllers = config('controllers') ?? [];
        foreach ($controllers as $controller) {
            $reflection = new ReflectionClass($controller);
            $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            
            foreach ($methods as $method) {
                $attributes = $method->getAttributes('App\Core\Route');
                if (count($attributes) && $attribute = $attributes[0]) {
                    $routerAttribute = $attribute->newInstance();
                    $path = $routerAttribute->path;
                    $requestMethod = $routerAttribute->requestType;

                    $this->addRoute($requestMethod, $path, [$controller, $method->getName()]);
                }
            }
        }
    }
}