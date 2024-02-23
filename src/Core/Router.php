<?php

namespace App\Core;

use ReflectionClass;
use ReflectionMethod;

/**
 * Router class.
 *
 * This class is responsible for routing incoming requests to controller methods based on defined routes.
 */
class Router {
    /** @var array An associative array to store registered routes. */
    private array $routes = [];
    
    /** @var string The request method (e.g., GET, POST, PUT, DELETE). */
    protected string $requestMethod;

    /**
     * Constructor.
     *
     * Initializes the router by generating routes and extracting the request method from the server.
     */
    public function __construct() {
        $this->generateRoutes();
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->handleRoute($_SERVER['REQUEST_URI']);
    }

    /**
     * Add a new route to the router.
     *
     * @param string $method The request method of the route.
     * @param string $path The URL path of the route.
     * @param array $controller An array containing the controller class and method name.
     * @return void
     */
    public function addRoute(string $method, string $path, array $controller): void {
        $this->routes[$method][$path] = $controller;
    }

    /**
     * Match a request to a registered route.
     *
     * @param string $method The request method.
     * @param string $uri The request URI.
     * @return array|null The controller class and method name if a match is found, or null otherwise.
     */
    public function match(string $method, string $uri): ?array {
        if (isset($this->routes[$method][$uri])) {
            return $this->routes[$method][$uri];
        }
        return null;
    }

    /**
     * Handle the incoming request by routing it to the appropriate controller method.
     *
     * @param string $request The incoming request.
     * @return void
     */
    public function handleRoute($request) {
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

    /**
     * Retrieve all registered routes.
     *
     * @return array All registered routes.
     */
    public function getRoutes(): array {
        return $this->routes;
    }

    /**
     * Generate routes based on controller methods annotated with Route attributes.
     *
     * @return void
     */
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
