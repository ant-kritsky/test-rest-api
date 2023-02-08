<?php

use app\Router;
use app\controllers\IndexController;

require_once __DIR__ . '/config.php';

Router::post('generate', [IndexController::class, 'generate']);
Router::get('retrieve/(\d+)', [IndexController::class, 'retrieve']);

try {
    Router::execute($_SERVER['REQUEST_URI']);
} catch (Exception $exception) {
    ApiResponse(404, ['message' => $exception->getMessage()]);
}