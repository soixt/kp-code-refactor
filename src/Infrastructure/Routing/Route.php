<?php

namespace App\Infrastructure\Routing;

/**
 * Route attribute class.
 *
 * This attribute class is used to annotate controller methods with route information.
 */
#[\Attribute(\Attribute::TARGET_METHOD)]
class Route {
    /**
     * Constructor.
     *
     * Initializes the Route attribute with the provided path, name, and request type.
     *
     * @param string $path The path of the route.
     * @param string $name The name of the route.
     * @param string $requestType The request type (e.g., GET, POST, PUT, DELETE).
     */
    public function __construct(
        public string $path,
        public string $name,
        public string $requestType
    ) {}
}
