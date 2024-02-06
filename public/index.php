<?php

use app\core\Application;
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application();


$app->router->get('/test', function () {
    return 'Test';
});

$app->run();