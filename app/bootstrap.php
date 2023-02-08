<?php

spl_autoload_register(function ($className) {
    $directory = __DIR__ . '/../';
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $directory . $className . '.php');

    if (file_exists($path)) {
        require_once($path);

        return true;
    }

    return false;
});

function ApiResponse($status, array $body = [])
{
    header('Content-Type: application/json');
    http_response_code($status);

    echo json_encode([
            'status' => $status,
        ] + $body, JSON_PRETTY_PRINT);
}
