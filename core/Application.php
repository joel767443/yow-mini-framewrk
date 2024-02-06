<?php

namespace app\core;
/**
 * Class Application
 * @package app/core
 */
class Application
{
    /**
     * @var Router
     */
    public Router $router;
    public Request $request;

    /**
     * Application Constructor
     */
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * @return void
     */
    public function run()
    {
        $this->router->resolve();
    }
}