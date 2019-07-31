<?php

namespace Request;

class Request
{
    public $get;

    public $post;

    public function __construct()
    {
        $this->post = $_POST;
        $this->get = $_GET;
    }
}
