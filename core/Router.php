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
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            return "Not found";
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    /**
     * @param string $view
     * @return string
     */
    private function renderView(string $view): string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_PATH . '/views/layouts/main.php';
        return ob_get_clean(); // cleanup content buffer
    }

    private function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_PATH . '/views/' . $view . '.php';
        return ob_get_clean(); // cleanup content buffer
    }
}