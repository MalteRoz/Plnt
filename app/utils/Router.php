<?php

class Router
{
    protected $routes = [];

    public function add($uri, $controller, $method, $function)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'function' => $function,
        ];
    }

    public function get($uri, $controller, $function)
    {
        $this->add($uri, $controller, 'GET', $function);
    }

    // public function post($uri, $controller)
    // {
    //     $this->add($uri, $controller, 'POST');
    // }

    // public function delete($uri, $controller)
    // {
    //     $this->add($uri, $controller, 'DELETE');
    // }

    // public function patch($uri, $controller)
    // {
    //     $this->add($uri, $controller, 'PATCH');
    // }

    public function route($uri, $method)
    {

        $uriWithoutQuery = strtok($uri, '?');

        foreach ($this->routes as $route) {
            if ($route['uri'] === $uriWithoutQuery && $route['method'] === strtoupper($method)) {
                require_once($route['controller']);

                $controllerName = basename($route['controller'], '.php');

                if (class_exists($controllerName)) {
                    $controllerInstance = new $controllerName();

                    return $controllerInstance->{$route['function']}($_GET);
                }
            }
        }

        $this->abort();
    }

    public function abort($code = 404)
    {

        http_response_code($code);

        require './app/views/404.view.php';

        die();
    }
}
