<?php

if (!function_exists('env')) {
    function env (string $key, mixed $default = '') {
        return getenv($key) ?? $default;
    }
}