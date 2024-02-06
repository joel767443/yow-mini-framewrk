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

    /**
     * @return mixed|string
     */
    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            Application::$app->response->setStatusCode(404);
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

    /**
     * @return false|string
     */
    private function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_PATH . '/views/layouts/main.php';
        return ob_get_clean(); // cleanup content buffer
    }

    /**
     * @param $view
     * @return false|string
     */
    private function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_PATH . '/views/' . $view . '.php';
        return ob_get_clean(); // cleanup content buffer
    }
}