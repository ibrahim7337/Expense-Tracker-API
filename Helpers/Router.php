<?php

declare(strict_types=1);

namespace Helpers;

class Router
{
    private static $routes = [];

    public static function get($path, $action)
    {
        self::$routes['GET'][$path] = $action;
    }

    public static function post($path, $action)
    {
        self::$routes['POST'][$path] = $action;
    }

    public static function dispatch($method, $uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        $action = self::$routes[$method][$path] ?? null;

        if (!$action) {
            http_response_code(404);
            echo json_encode([
                "status" => "error",
                "message" => "Route not found"
            ]);
            return;
        }

        [$controller, $methodName] = $action;

        $controllerInstance = new $controller();

        $response = $controllerInstance->$methodName();

        echo $response;
    }
}
