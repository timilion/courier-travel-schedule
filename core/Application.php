<?php

namespace core;

/**
 * [Application description]
 */
class Application
{
    private $rewrite = [];


    public function run(array $rewrite)
    {
        $this->rewrite = $rewrite;
        $path = explode('?', $_SERVER['REQUEST_URI']);
        $path = array_shift($path);
        $route = isset($this->rewrite[$path]) ? $this->rewrite[$path] : null;
        if ($route) {
            extract($route);
            $model = new $class();
            if (method_exists($model, $action)) {
                echo  $model->$action();
                exit;
            }
        }
        $this->close();
        return '';
    }

    public function close()
    {
        http_response_code(404);
        die;
    }
}
