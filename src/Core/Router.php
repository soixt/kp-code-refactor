<?php

namespace App\Core;

use ReflectionClass;
use ReflectionMethod;

class Router {
    private array $routes = [];

    public function __construct() {
        $this->generateRoutes();
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

    public function getRoutes(): array {
        return $this->routes;
    }

    public function generateRoutes(): void {
        $controllers = config('controllers') ?? [];
        foreach ($controllers as $controller) {
            $reflection = new ReflectionClass($controller);
            $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
            
            foreach ($methods as $method) {
                $attributes = $method->getAttributes();
                
                foreach ($attributes as $attribute) {
                    $attributeName = $attribute->getName();
                    
                    if ($attributeName === 'Route') {
                        $routerAttribute = $attribute->newInstance();
                        $path = $routerAttribute->path;
                        $requestMethod = $routerAttribute->requestType;

                        $this->addRoute($requestMethod, $path, [$controller, $method->getName()]);
                    }
                }
            }
        }
    }
}