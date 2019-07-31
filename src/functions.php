<?php

use Router\Router;

function url($name)
{
    $router = new Router();
    return $router->generate($name);
}

function currentDateTime()
{
    return date('Ymd-h:i:s', time());
}

function trans(string $file, string $key, string $attribute = null, string $additional = null)
{
    $trans = require(ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'lang' . DIRECTORY_SEPARATOR . $file . '.php');
    $message = str_replace(':attribute', $attribute, $trans[$key]);
    $message = str_replace(':additional', $additional, $message);
    return $message;
}
