<?php

namespace app\controllers;

use app\core\Application;

class Controller
{

    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function view(string $view, array $params = []): string
    {
        return Application::$app->router->renderView($view);
    }
}