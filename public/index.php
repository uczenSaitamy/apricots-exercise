<?php

require '../vendor/autoload.php';

use Router\Router;
use Request\Request;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

define('ROOT', dirname(__DIR__));

try {
    $router = new Router;
    $request = new Request;

    $logger = new Logger('main');
    $logger->pushHandler(new StreamHandler(ROOT . DIRECTORY_SEPARATOR .
        'storage' . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'app.log', Logger::DEBUG));

    $current = $router->execute();

    $controllerName = sprintf('App\Controllers\%s', $current['controller']);
    $controller = new $controllerName($request, $logger);

    $controller->{$current['action']}();
} catch (\Throwable $throwable) {
    xdebug_print_function_stack($throwable);
}
