<?php

/**
 * Retrieve an environment variable value.
 *
 * @param string $key The name of the environment variable.
 * @param mixed $default The default value to return if the environment variable is not set.
 * @return mixed The value of the environment variable, or the default value if not set.
 */
if (!function_exists('env')) {
    function env (string $key, mixed $default = '') {
        return $_ENV[$key] ?? $default;
    }
}

/**
 * Retrieve a configuration value.
 *
 * @param string $key The configuration key to retrieve.
 * @param mixed $default The default value to return if the configuration key is not found.
 * @return mixed The configuration value, or the default value if the key is not found.
 */
if (!function_exists('config')) {
    function config (string $key, mixed $default = '') {
        return App\Core\Config::get($key) ?? $default;
    }
}

/**
 * Abort the execution of the script with a specific HTTP status code.
 *
 * @param int $code The HTTP status code to send.
 * @return void
 */
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

/**
 * Send a JSON response with optional data.
 *
 * @param array $data The data to include in the response.
 * @return void
 */
if (!function_exists('response')) {
    function response (array $data = ['success' => true]) {
        header('Content-Type: application/json');
        echo json_encode($data);
        die();
    }
}
