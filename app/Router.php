<?php

namespace app;

class Router
{
    private static $routes = [];

    private function __construct() {}

    private function __clone() {}

    public static function post($pattern, $callback)
    {
        self::route('POST', $pattern, $callback);
    }

    public static function get($pattern, $callback)
    {
        self::route('GET', $pattern, $callback);
    }

    /**
     * @param string $type Type of request
     * @param string $pattern
     * @param callable $callback
     */
    private static function route($type, $pattern, $callback)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$type][$pattern] = $callback;
    }

    /**
     * @param $url
     * @return false|mixed
     * @throws \Exception
     */
    public static function execute($url)
    {
        $routes = self::$routes[$_SERVER['REQUEST_METHOD']] ?? 'GET';

        foreach ($routes as $pattern => $callback) {
            $url = strtok(trim($url, '/'), '?') ?: '/';

            if (preg_match($pattern, $url, $params)) {
                array_shift($params);

                if (is_array($callback) && class_exists($callback[0])) {
                    $callback[0] = new $callback[0];
                }

                return call_user_func_array($callback, array_values($params));
            }
        }

        throw new \Exception('Endpoint not found');
    }
}