<?php

namespace app\core;
/**
 * Class Application
 * @package app/core
 */
class Application
{
    /**
     * @var string
     */
    public static string $ROOT_PATH;
    /**
     * @var Router
     */
    public Router $router;
    /**
     * @var Request
     */
    public Request $request;
    /**
     * @var Response
     */
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
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * @return void
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}