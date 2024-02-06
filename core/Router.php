<?php

namespace app\core;

/**
 * Class Router
 * @package app/core
 */
class Router
{

    /**
     * @var Request
     */
    public Request $request;

    /**
     * Router Constructor
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * @var array
     */
    protected array $routes = [];

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public function get($path, $callback)
    {
        var_dump($path);
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @return void
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            echo "Not found";
            exit;
        }

        echo call_user_func($callback);
    }
}