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
    public Response $response;
    public static Application $app;

    /**
     * Application Constructor
     */
    public function __construct($rootPath)
    {
        self::$ROOT_PATH = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
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