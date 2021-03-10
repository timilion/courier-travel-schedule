<?php

namespace core;

/**
 * [Application description]
 */
class Application
{
    private $rewrite = [];


    public function __construct(array $rewrite)
    {
        $this->rewrite = $rewrite;
    }


    public function run()
    {
        $route = isset($this->rewrite[$_SERVER['REQUEST_URI']]) ? $this->rewrite[$_SERVER['REQUEST_URI']] : null;
        if ($route) {
            extract($route);
            $model = new $class();
            if (method_exists($model, $action)) {
                return $model->$action();
            }
        }
        $this->close();
    }

    public function close()
    {
        http_response_code(404);
        die;
    }
}
