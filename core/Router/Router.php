<?php

namespace Router;

class Router
{
    private $routes;

    private $current;

    public function __construct()
    {
        $this->current = $_SERVER['REQUEST_URI'];
        $routes = include(ROOT . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routes.php');

        foreach ($routes as $name => $data) {
            $this->add($name, $data);
        }
    }

    protected function add(string $name, array $data, string $method = 'GET')
    {
        $piece = $this->separate($data[0]);

        $this->routes[$name]['controller'] = $piece['controller'];
        $this->routes[$name]['action'] = $piece['action'];
        $this->routes[$name]['url'] = $data[1];
        $this->routes[$name]['method'] = $data[2] ?? $method;
    }

    protected function separate(string $closure): array
    {
        $piece = explode('@', $closure, 2);

        return [
            'controller' => $piece[0],
            'action' => $piece[1],
        ];
    }

    public function execute()
    {
        foreach ($this->routes as $name => $data) {
            if ($data['url'] === $this->current && $data['method'] === $_SERVER['REQUEST_METHOD']) {
                return $this->routes[$name];
            }
        }
        return $this->get404();
    }

    protected function get404()
    {
        return [
            'controller' => 'BaseController',
            'action' => 'error404',
            'method' => 'GET'
        ];
    }

    public function getRoute($name)
    {
        if (isset($this->routes[$name])) {
            return $this->routes[$name];
        }
        return $this->get404();
    }

    public function generate($name)
    {
        $data = $this->getRoute($name);
        return $data['url'];
    }
}
