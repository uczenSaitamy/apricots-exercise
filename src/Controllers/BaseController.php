<?php

namespace App\Controllers;

use Request\Request;
use Monolog\Logger;

class BaseController
{
    protected $request;

    protected $logger;

    public function __construct(Request $request, Logger $logger)
    {
        $this->request = $request;
        $this->logger = $logger;
    }

    public function error404()
    {
        $error['code'] = '404';
        $error['message'] = 'Page not found.';
        $this->render('error', ['error' => $error]);
    }

    public function render(string $view, array $vars = [])
    {
        $old = $this->request->post;
        extract($vars);
        ob_start();
        require(ROOT . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR  . 'index.php');
        $content = ob_get_clean();
        echo $content;
    }
}
