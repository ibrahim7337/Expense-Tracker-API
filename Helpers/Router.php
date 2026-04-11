<?php

declare(strict_types=1);

namespace Helpers;

class Router
{
    /**
     * @var array<string, array<string, array{string, string}>>
     */
    private static array $routes = [];

    /**
     * Summary of get
     * @param mixed $path
     * @param mixed $action
     *
     * @return void
     */
    public static function get(mixed $path, mixed $action): void
    {
        self::$routes['GET'][$path] = $action;
    }

    /**
     * Summary of post
     * @param mixed $path
     * @param mixed $action
     *
     * @return void
     */
    public static function post(mixed $path, mixed $action): void
    {
        self::$routes['POST'][$path] = $action;
    }

    /**
     * Summary of dispatch
     * @param mixed $method
     * @param mixed $uri
     *
     * @return void
     */
    public static function dispatch(mixed $method, mixed $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if (!is_string($path)) {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Route not found',
            ]);
            return;
        }

        if (!isset(self::$routes[$method][$path])) {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Route not found',
            ]);
            return;
        }

        $action = self::$routes[$method][$path];

        [$controller, $methodName] = $action;

        $controllerInstance = new $controller();

        $response = $controllerInstance->$methodName();

        echo $response;
    }
}
