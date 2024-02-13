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

if (!function_exists('abort')) {
    function abort (int $code = 404) {
        $messages = [
            200 => 'OK',
            201 => 'Created',
            204 => 'No Content',
            400 => 'Bad Request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ];
        http_response_code($code);
        echo $messages[$code];
        die();
    }
}

if (!function_exists('response')) {
    function response (array $data = ['success' => true]) {
        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }
}