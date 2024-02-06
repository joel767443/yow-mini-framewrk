<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use app\controllers\SiteController;
use app\core\Application;
require_once __DIR__ . '/../vendor/autoload.php';

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'store']);

$app->run();