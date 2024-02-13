<?php

namespace App\Core;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Route {
    public function __construct(
        public string $path,
        public string $name,
        public string $requestType
    ) {}
}