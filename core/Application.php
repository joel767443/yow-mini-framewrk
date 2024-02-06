<?php

namespace app\core;
/**
 * Class Application
 * @package app/core
 */
class Application
{
    public static string $ROOT_PATH;
    /**
     * @var Router
     */
    public Router $router;
    public Request $request;

    /**
     * Application Constructor
     */
    public function __construct($rootPath)
    {
        self::$ROOT_PATH = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}