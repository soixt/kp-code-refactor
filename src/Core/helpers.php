<?php

if (!function_exists('env')) {
    function env (string $key, mixed $default = '') {
        return getenv($key) ?? $default;
    }
}

if (!function_exists('config')) {
    function config (string $key, mixed $default = '') {
        return App\Core\Config::get($key) ?? $default;
    }
}